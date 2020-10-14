<?php
Co::set(['hook_flags'=> SWOOLE_HOOK_ALL]);

Co\run(function () {
    $client = new Swoole\Coroutine\Http\Client('wiki.swoole.com', 80);
    $client->setHeaders([
        'Host' => 'localhost',
        'User-Agent' => 'Chrome/49.0.2587.3',
        'Accept' => 'text/html,application/xhtml+xml,application/xml',
        'Accept-Encoding' => 'gzip',
    ]);
    $client->set(['timeout' => 1]);
    $client->get('/');
    echo $client->body;
    $client->close();
});
