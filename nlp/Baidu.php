<?php
namespace nlp;

use Swoole\Coroutine\Http\Client;

class Baidu implements NlpInterface,NlpBaiduInterface
{
    var $config =[
        'outTime'=>1
        ,'baidu'=>[
            'client_secret'=>''
            ,'client_id'=>''
        ]
        ,'tencent'=>[]
    ];

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function auth()
    {
        // TODO: Implement GetAccessToken() method.
        go(function (){
            $data['client_secret'] = $this->config['baidu']['client_secret'];
            $data['client_id'] = $this->config['baidu']['client_id'];
            $data['grant_type'] = 'client_credentials';
            $client = new Client('aip.baidubce.com',80);
            $client->set(['timeout'=>$this->config['outTime']]);
            $client->post('/oauth/2.0/token',$data);
            echo $client->getBody();
            $client->close();

        });

    }

    public function lexer()
    {
        // TODO: Implement lexer() method.
    }

    public function dnnlmCn()
    {
        // TODO: Implement dnnlmCn() method.
    }
}