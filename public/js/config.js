var app = angular.module('app');

var config = {
    'AppName3' : 'AngularJS TIPS3',
    'AppName5' : 'AngularJS TIPS5',
    'ValidationRule': {
      number    : /^\d+$/,
      zipcode1  : /^[0-9]{3}$/,
      zipcode2  : /^[0-9]{4}$/,
      tel       : /^0[0-9]{8,9}$/,
      mobiletel : /^0[7-9]0[0-9]{7,8}$/,
      katakana  : /^[ァ-ヶー]{1}[ァ-ヶー 　]+$/,
      hiragana  : /^[ぁ-んー$]{1}[ぁ-んー 　]+$/,
      hankaku   : /^[ -~｡-ﾟ]*$/,
      zenkaku   : /^[^ -~｡-ﾟ]*$/,
      email     : /^[^@]{1,64}@[^@]{1,255}$/, // RFC822
    },
      'ValidationMessage': {
      'required'  : '必須項目のため、必ず入力してください。',
      'tel'       : '形式が正しくありません。',
      'mobiletel' : '形式が正しくありません。',
      'zipcode'   : '形式が正しくありません。',
      'katakana'  : '形式が正しくありません。',
      'hiragana'  : '形式が正しくありません。',
      'date'      : '日付を正しく入力してください。',
      'email'     : 'メールアドレスを正しく入力してください。',
      'max'       : '%s 文字以内で入力してください。',
      'min'       : '%s 文字以上で入力してください。',
      'size'      : '%s MB以内のファイルを選択してください。',
      'accept'    : '「%s」形式のファイルを選択してください。',
      'same'      : '入力値が一致していません。',
      'cx_tablet' : 'その他を選択した場合は、ご利用の端末名称入力してください。',
    },
};

app.value('config', config);
