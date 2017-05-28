<?php


$from_arr = array(" ", "data:image/png;base64,", "data:image/jpg;base64,", "data:image/jpeg;base64,", "data:image/gif;base64,", "data:application/pdf;base64,");
$to_arr   = array("+", "", "", "", "");

$m_ext = ['', '.png', '.jpg', '.jpg', '.gif', '.pdf'];

// check extension
$ext = "";
foreach($from_arr as $key => $from) {
    if ($key == 1) continue;
    if (strstr($_POST['file'], $from)) {
        $ext = $m_ext[$key];
    }
}

//base64からバイナリ画像に変換
$file    = base64_decode( str_replace($from_arr, $to_arr, $_POST['file']));

//ファイル出力
$tmpfilename = tempnam("../../uploads/tmp/", "");
file_put_contents($tmpfilename . $ext, $file);
unlink($tmpfilename);

echo json_encode($tmpfilename . $ext);
