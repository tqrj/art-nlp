<?php
Co::set(['hook_flags'=> SWOOLE_HOOK_ALL]);

Co\run(function () {
    $client = new Swoole\Coroutine\Http\Client('wiki.swoole.com', 80);
    $client->set(['timeout' => 1]);
    $client->get('/');
    echo $client->body;
    $client->close();
});
