<?php
require 'vendor/autoload.php';

Co::set(['hook_flags'=> SWOOLE_HOOK_ALL]);

Co\run(function () {
    $config =[
        'outTime'=>1
        ,'baidu'=>[
            'client_secret'=>'Rgzet1AGVoXZWpKhLvrhPnw88YO5cEu1'
            ,'client_id'=>'01YwOC1j83a5TgKIzFMAP1cI'
        ]
        ,'tencent'=>[]
    ];
    $baidu = new \nlp\Baidu($config);
    echo $baidu->auth();
    echo $baidu->auth();
});
