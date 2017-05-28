"use strict";
/**
 * @class elFinder command "edit". 
 * Edit text file in dialog window
 *
 * @author Dmitry (dio) Levashov, dio@std42.ru
 **/
elFinder.prototype.commands.edit = function() {
	var self  = this,
		fm    = this.fm,
		mimes = fm.res('mimes', 'text') || [],
		binMimeRegex,
		rtrim = function(str){
			return str.replace(/\s+$/, '');
		},
		getEncSelect = function(heads) {
			var sel = $('<select class="ui-corner-all"/>'),
				hval;
			if (heads) {
				$.each(heads, function(i, head) {
					hval = fm.escape(head.value);
					sel.append('<option value="'+hval+'">'+(head.caption? fm.escape(head.caption) : hval)+'</option>');
				});
			}
			$.each(self.options.encodings, function(i, v) {
				sel.append('<option value="'+v+'">'+v+'</option>');
			});
			return sel;
		},
	
		/**
		 * Return files acceptable to edit
		 *
		 * @param  Array  files hashes
		 * @return Array
		 **/
		filter = function(files) {
			return $.map(files, function(file) {
				return (file.mime.indexOf('text/') === 0 || $.inArray(file.mime, mimes) !== -1 || binMimeRegex.test(file.mime)) 
					&& file.mime.indexOf('text/rtf')
					&& (!self.onlyMimes.length || $.inArray(file.mime, self.onlyMimes) !== -1)
					&& file.read && file.write ? file : null;
			});
		},
		
		/**
		 * Open dialog with textarea to edit file
		 *
		 * @param  String  id       dialog id
		 * @param  Object  file     file object
		 * @param  String  content  file content
		 * @return $.Deferred
		 **/
		dialog = function(id, file, content, encoding) {

			var dfrd = $.Deferred(),
				save = function(hash) {
					ta.editor && ta.editor.save(ta[0], ta.editor.instance);
					old = ta.getContent();
					dfrd.notifyWith(ta, [selEncoding? selEncoding.val():void(0), hash]);
				},
				cancel = function() {
					ta.elfinderdialog('close');
				},
				savecl = function() {
					save();
					cancel();
				},
				saveAs = function() {
					var prevOld = old,
						fail = function() {
							old = prevOld;
							dialogNode.fadeIn();
						};
					
					self.mime = file.mime;
					self.prefix = file.name;
					self.requestCmd = 'mkfile';
					self.nextAction = { cmd: 'edit', msg: 'cmdedit' };
					dialogNode.fadeOut();
					$.proxy(fm.res('mixin', 'make'), self)()
						.done(function(data) {
							if (data.added && data.added.length) {
								save(data.added[0].hash);
								dialogNode.show();
								cancel();
							} else {
								fail();
							}
						})
						.fail(fail);
				},
				changed = function() {
					ta.editor && ta.editor.save(ta[0], ta.editor.instance);
					return  (old !== ta.getContent());
				},
				opts = {
					title   : fm.escape(file.name),
					width   : self.options.dialogWidth || (Math.min(650, $(window).width() * .9)),
					buttons : {},
					allowMaximize : true,
					btnHoverFocus : false,
					closeOnEscape : false,
					close   : function() {
						var close = function(){
							dfrd.resolve();
							ta.editor && ta.editor.close(ta[0], ta.editor.instance);
							ta.elfinderdialog('destroy');
						};
						fm.toggleMaximize($(this).closest('.ui-dialog'), false);
						if (changed()) {
							fm.confirm({
								title  : self.title,
								text   : 'confirmNotSave',
								accept : {
									label    : 'btnSaveClose',
									callback : function() {
										save();
										close();
									}
								},
								cancel : {
									label    : 'btnClose',
									callback : close
								},
								buttons : [{
									label    : 'btnSaveAs',
									callback : function() {
										saveAs();
									}
								}]
							});
						} else {
							close();
						}
					},
					open    : function() {
						var loadRes;
						ta.initEditArea(id, file, content, fm);
						old = ta.getContent();
						fm.disable();
						if (ta.editor) {
							loadRes = ta.editor.load(ta[0]) || null;
							if (loadRes && loadRes.done) {
								loadRes.done(function(instance) {
									ta.editor.instance = instance;
									ta.editor.focus(ta[0], ta.editor.instance);
									old = ta.getContent();
								});
							} else {
								ta.editor.instance = loadRes;
								ta.editor.focus(ta[0], ta.editor.instance);
								old = ta.getContent();
							}
						}
					},
					resize : function(e, data) {
						ta.editor && ta.editor.resize(ta[0], ta.editor.instance, e, data || {});
					}
				},
				mimeMatch = function(fileMime, editorMimes){
					editorMimes = editorMimes || mimes.concat('text/');
					if ($.inArray(fileMime, editorMimes) !== -1 ) {
						return true;
					}
					var i, l;
					l = editorMimes.length;
					for (i = 0; i < l; i++) {
						if (fileMime.indexOf(editorMimes[i]) === 0) {
							return true;
						}
					}
					return false;
				},
				extMatch = function(fileName, editorExts){
					if (!editorExts || !editorExts.length) {
						return true;
					}
					var ext = fileName.replace(/^.+\.([^.]+)|(.+)$/, '$1$2').toLowerCase(),
					i, l;
					l = editorExts.length;
					for (i = 0; i < l; i++) {
						if (ext === editorExts[i].toLowerCase()) {
							return true;
						}
					}
					return false;
				},
				ta, old, dialogNode, selEncoding, extEditor;
				
			$.each(self.options.editors || [], function(i, editor) {
				if (mimeMatch(file.mime, editor.mimes || null)
				&& extMatch(file.name, editor.exts || null)
				&& typeof editor.load == 'function'
				&& typeof editor.save == 'function') {
					if (editor.html) {
						ta = $(editor.html);
					}
					
					extEditor = {
						init     : editor.init || null,
						load     : editor.load,
						getContent : editor.getContent || null,
						save     : editor.save,
						close    : typeof editor.close == 'function' ? editor.close : function() {},
						focus    : typeof editor.focus == 'function' ? editor.focus : function() {},
						resize   : typeof editor.resize == 'function' ? editor.resize : function() {},
						instance : null,
						doSave   : save,
						doCancel : cancel,
						doClose  : savecl,
						file     : file,
						fm       : fm
					};
					
					return false;
				}
			});
			
			if (!ta) {
				if (file.mime.indexOf('text/') !== 0 && $.inArray(file.mime, mimes) === -1) {
					return dfrd.reject('errEditorNotFound');
				}
				(function() {
					var stateChange = function() {
							if (selEncoding) {
								if (changed()) {
									selEncoding.attr('title', fm.i18n('saveAsEncoding')).addClass('elfinder-edit-changed');
								} else {
									selEncoding.attr('title', fm.i18n('openAsEncoding')).removeClass('elfinder-edit-changed');
								}
							}
						};
						
					ta = $('<textarea class="elfinder-file-edit '+fm.res('class', 'editing')+'" rows="20" id="'+id+'-ta"></textarea>')
						.on('input propertychange', stateChange);

					ta.initEditArea = function(id, file, content) {
						var heads = (encoding && encoding !== 'unknown')? [{value: encoding}] : [];
						ta.val(content);
						if (content === '' || ! encoding || encoding !== 'UTF-8') {
							heads.push({value: 'UTF-8'});
						}
						selEncoding = getEncSelect(heads).on('touchstart', function(e) {
							// for touch punch event handler
							e.stopPropagation();
						}).on('change', function() {
							// reload to change encoding if not edited
							if (! changed() && ta.getContent() !== '') {
								cancel();
								edit(file, $(this).val());
							}
						}).on('mouseover', stateChange);
						ta.parent().prev().find('.elfinder-titlebar-button:last')
							.after($('<span class="elfinder-titlebar-button-right"/>').append(selEncoding));
						
						//fm.disable();
						ta.focus(); 
						ta[0].setSelectionRange && ta[0].setSelectionRange(0, 0);
					};
				})();
			}
			
			if (extEditor) {
				ta.editor = extEditor;
				if (typeof extEditor.init === 'function') {
					ta.initEditArea = extEditor.init;
				}
				
				if (typeof extEditor.getContent === 'function') {
					ta.getContent = extEditor.getContent;
				}
			}
			
			if (! ta.initEditArea) {
				ta.initEditArea = function() {};
			}
			
			if (! ta.getContent) {
				ta.getContent = function() {
					return rtrim(ta.val());
				};
			}
			
			if (!ta.editor) {
				ta.keydown(function(e) {
					var code = e.keyCode,
						value, start;
					
					e.stopPropagation();
					if (code == $.ui.keyCode.TAB) {
						e.preventDefault();
						// insert tab on tab press
						if (this.setSelectionRange) {
							value = this.value;
							start = this.selectionStart;
							this.value = value.substr(0, start) + "\t" + value.substr(this.selectionEnd);
							start += 1;
							this.setSelectionRange(start, start);
						}
					}
					
					if (e.ctrlKey || e.metaKey) {
						// close on ctrl+w/q
						if (code == 'Q'.charCodeAt(0) || code == 'W'.charCodeAt(0)) {
							e.preventDefault();
							cancel();
						}
						if (code == 'S'.charCodeAt(0)) {
							e.preventDefault();
							save();
						}
					}
					
				}).on('mouseenter', function(){this.focus();});
			}
			
			opts.buttons[fm.i18n('btnSave')]      = save;
			opts.buttons[fm.i18n('btnSaveClose')] = savecl;
			opts.buttons[fm.i18n('btnSaveAs')]    = saveAs;
			opts.buttons[fm.i18n('btnCancel')]    = cancel;
			
			dialogNode = fm.dialog(ta, opts)
				.attr('id', id)
				.on('keydown keyup keypress', function(e) {
					e.stopPropagation();
				}).closest('.ui-dialog');
			
			return dfrd.promise();
		},
		
		/**
		 * Get file content and
		 * open dialog with textarea to edit file content
		 *
		 * @param  String  file hash
		 * @return jQuery.Deferred
		 **/
		edit = function(file, conv) {
			var hash   = file.hash,
				opts   = fm.options,
				dfrd   = $.Deferred(), 
				data   = {cmd : 'file', target : hash},
				id     = 'edit-'+fm.namespace+'-'+file.hash,
				d      = fm.getUI().find('#'+id),
				conv   = !conv? 0 : conv,
				error;
			
			
			if (d.length) {
				d.elfinderdialog('toTop');
				return dfrd.resolve();
			}
			
			if (!file.read || !file.write) {
				error = ['errOpen', file.name, 'errPerm'];
				fm.error(error);
				return dfrd.reject(error);
			}
			
			fm.request({
				data   : {cmd : 'get', target  : hash, conv : conv},
				notify : {type : 'file', cnt : 1}
			})
			.done(function(data) {
				var selEncoding;
				if (data.doconv) {
					fm.confirm({
						title  : self.title,
						text   : data.doconv === 'unknown'? 'confirmNonUTF8' : 'confirmConvUTF8',
						accept : {
							label    : 'btnConv',
							callback : function() {  
								dfrd = edit(file, selEncoding.val());
							}
						},
						cancel : {
							label    : 'btnCancel',
							callback : function() { dfrd.reject(); }
						},
						optionsCallback : function(options) {
							options.create = function() {
								var base = $('<div class="elfinder-dialog-confirm-encoding"/>'),
									head = {value: data.doconv},
									detected;
								
								if (data.doconv === 'unknown') {
									head.caption = '-';
								}
								selEncoding = getEncSelect([head]);
								$(this).next().find('.ui-dialog-buttonset')
									.prepend(base.append($('<label>'+fm.i18n('encoding')+' </label>').append(selEncoding)));
							}
						}
					});
				} else {
					dialog(id, file, data.content, data.encoding)
						.done(function(data) {
							dfrd.resolve(data);
						})
						.progress(function(encoding, newHash) {
							var ta = this;
							if (newHash) {
								hash = newHash;
							}
							fm.request({
								options : {type : 'post'},
								data : {
									cmd     : 'put',
									target  : hash,
									encoding : encoding || data.encoding,
									content : ta.getContent()
								},
								notify : {type : 'save', cnt : 1},
								syncOnFail : true
							})
							.fail(function(error) {
								dfrd.reject(error);
							})
							.done(function(data) {
								data.changed && data.changed.length && fm.change(data);
								setTimeout(function(){
									ta.focus();
									ta.editor && ta.editor.focus(ta[0], ta.editor.instance);
								}, 50);
							});
						})
						.fail(function(error) {
							dfrd.reject(error);
						});
				}
			})
			.fail(function(error) {
				var err = Array.isArray(error)? error[0] : error;
				(err !== 'errConvUTF8') && fm.sync();
				dfrd.reject(error);
				
			});

			return dfrd.promise();
		};
	
	
	
	this.shortcuts = [{
		pattern     : 'ctrl+e'
	}];
	
	this.init = function() {
		this.onlyMimes = this.options.mimes || [];
		binMimeRegex = self.options.binMimeRegex? self.options.binMimeRegex : /$^/;
	};
	
	this.getstate = function(sel) {
		var sel = this.files(sel),
			cnt = sel.length;

		return cnt && filter(sel).length == cnt ? 0 : -1;
	};
	
	this.exec = function(hashes) {
		var fm    = this.fm, 
			files = filter(this.files(hashes)),
			list  = [],
			file;

		while ((file = files.shift())) {
			list.push(edit(file).fail(function(error) {
				error && fm.error(error);
			}));
		}
		
		return list.length 
			? $.when.apply(null, list)
			: $.Deferred().reject();
	};

};
