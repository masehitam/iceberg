<?php

$request = file_get_contents("php://input");
$req     = json_decode($request);

//var_dump($req);

// sample code.
$addr = [
'pref' => '27',
'addr' => '大阪市北区1丁目',
];

echo json_encode($addr);
