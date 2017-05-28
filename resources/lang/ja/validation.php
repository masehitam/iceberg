<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"       => ":attributeを同意してください。",
	"active_url"     => "URLを正しく入力してください。",
	"after"          => ":attributeには、:date以降の日付を指定してください。",
	"alpha"          => ":attributeはアルファベッドのみがご利用できます。",
	"alpha_dash"     => ":attributeは英数字とダッシュ(-)及び下線(_)がご利用できます。",
	"alpha_num"      => ":attributeは英数字がご利用できます。",
	"array"          => "The :attribute must have selected elements.",
	"before"         => ":attributeには、:date以前の日付をご利用ください。",
	"between"        => array(
		"numeric" => ":attributeは、:minから、:maxまでの数字をご指定ください。",
		"file"    => ":attributeには、:min kBから:max kBまでのサイズのファイルをご指定ください。",
		"string"  => ":min文字から:max文字の間で入力してください。",
		"array"   => "The :attribute must have between :min and :max items.",
	),
	"boolean"              => "The :attributeは「はい」か「いいえ」を指定してください。",
	"confirmed"      => "パスワードが一致していません。",
	"date"           => "日付を正しく入力してください。",
	"date_format"    => ":attributeは:format形式で入力してください。",
	"different"      => ":attributeと:otherには、異なった内容を指定してください。",
	"digits"         => ":digits桁で入力してください。",
	"digits_between" => ":min～:max桁の範囲で入力してください。",
	"email"          => "メールアドレスを正しく入力してください。",
	"exists"         => "選択された値は正しくありません。",
	"image"          => ":attributeには画像ファイルを指定してください。",
	"in"             => "選択された値は正しくありません。",
	"integer"        => "整数で入力してください。",
	"ip"             => ":attributeには、有効なIPアドレスをご指定ください。",
	"max"            => array(
		"numeric" => ":attributeには、:max以下の数字をご指定ください。",
		"file"    => ":attributeには、:max kB以下のファイルをご指定ください。",
		"string"  => ":max文字以下で入力してください。",
		"array"   => "The :attribute may not have more than :max items.",
	),
	"mimes"          => ":attributeには:valuesタイプのファイルを指定してください。",
	"min"            => array(
		"numeric" => ":attributeには、:min以上の数字をご指定ください。",
		"file"    => ":attributeには、:min kB以上のファイルをご指定ください。",
		"string"  => ":attributeは、:min文字以上で入力してください。",
		"array"   => "The :attribute must have at least :min items.",
	),
	"not_in"         => "選択された:attributeは正しくありません。",
	"numeric"        => "数字を指定してください。",
	"regex"          => "形式が正しくありません。",
	"required"       => "必須項目のため、必ず入力してください。",
	"required_if"          => ":otherが:valueである場合、:attributeは必ず指定してください。",
	"required_with"        => ":valuesが指定されている場合、:attributeは必ず指定してください。",
	"required_with_all"    => "The :attribute field is required when :values is present.",
	"required_without"     => ":valuesが指定されていない場合、:attributeは必ず指定してください。",
	"required_without_all" => "The :attribute field is required when none of :values are present.",
	"same"                 => ":attributeと:otherには同じ値を指定してください。",
	"size"                 => array(
		"numeric"      => ":attributeには:sizeを指定してください。",
		"file"         => ":attributeのファイルは、:sizeキロバイトでなくてはなりません。",
		"string"       => ":attributeは:size文字で指定してください。",
		"array"        => "The :attribute must contain :size items.",
	),
	"unique"         => "入力された値は既に登録されています。",
	"url"            => "フォーマットが正しくありません。",
	"timezone"       => "The :attributeが正しい標準時間帯設定ではありません。",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
		'attribute-name' => [
			'rule-name' => 'custom-message',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [],

];
