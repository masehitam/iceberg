<?php

$themes = ['Yellow', 'Black', 'Pink'];

for ($i=1; $i<=10000; $i++) {
    $list[] =[
      'id'     => (string)$i, //sprintf('%03d', $i);
      'number' => sprintf('%09d', $i),
      'mail'   => 'tanaka.ichiro+' . sprintf('%03d', $i) . '@hoge.com',
      'name01' => '田中一郎' . sprintf('%03d', $i),
      'status' => ($i%2)? '利用可能':'利用不可',
      'theme'  => $themes[$i%3],
    ];
}

echo json_encode($list);
