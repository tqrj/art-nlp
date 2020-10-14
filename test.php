<?php
$client = new Swoole\Coroutine\Http\Client('https://www.baidu.com/', 80);
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