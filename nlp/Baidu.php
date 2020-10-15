<?php
namespace nlp;

use Swoole\Coroutine\Http\Client;

class Baidu implements NlpInterface,NlpBaiduInterface
{
    var $config =[
        'outTime'=>1
        ,'baidu'=>[
            'client_secret'=>'',
            'client_id'=>'',
            'access_token'=>''
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
        $body = '';
//        go(function () use (&$body){
//
//        });
        $data['client_secret'] = $this->config['baidu']['client_secret'];
        $data['client_id'] = $this->config['baidu']['client_id'];
        $data['grant_type'] = 'client_credentials';
        $client = new Client(self::BaiduDomain,80);
        $client->set(['timeout'=>$this->config['outTime']]);
        $client->post('/oauth/2.0/token',$data);
        $body = $client->getBody();
        $client->close();
        $this->config['baidu']['access_token'] = json_decode($body,true)['access_token'];
        return $this->config['baidu']['access_token'];
    }

    public function lexer($text)
    {
        // TODO: Implement lexer() method.
        $data['access_token'] = $this->config['baidu']['access_token'];
        $data['text'] = $text;
        $client = new Client(self::BaiduDomain,80);
        $client->post('/rpc/2.0/nlp/v1/lexer',$data);
        return json_decode($client->getBody(),true);
    }

    /**
     * @param string $text 文本内容，最大256字节，不需要切词
     * @return mixed
     */
    public function dnnlmCn($text)
    {
        // TODO: Implement dnnlmCn() method.
        $data['text'] =$text;
        $data = json_encode($data,JSON_UNESCAPED_UNICODE);
        $client = new Client(self::BaiduDomain,443,true);
        $client->post('/rpc/2.0/nlp/v2/dnnlm_cn?access_token='.$this->config['baidu']['access_token'],$data);
        echo $client->body;
        return json_decode($client->getBody(),true);
    }
}