<?php
require 'vendor/autoload.php';

Co::set(['hook_flags'=> SWOOLE_HOOK_ALL]);

Co\run(function () {
    $config =[
        'outTime'=>1,
        'baidu'=>[
            'client_secret'=>'Rgzet1AGVoXZWpKhLvrhPnw88YO5cEu1',
            'client_id'=>'01YwOC1j83a5TgKIzFMAP1cI',
            'access_token'=>'24.5cea6c2c707cc1c8958e4678c55589e3.2592000.1605338030.282335-22807326'
        ]
        ,'tencent'=>[]
    ];
    $baidu = new \nlp\Baidu($config);
    echo $baidu->auth().PHP_EOL;
    print_r($baidu->keyword('我想你了','我真q好想你，每天都会想起你，好想每天早上第一眼见到的就是你'));
});
