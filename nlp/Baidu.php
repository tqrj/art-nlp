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

    /**
     * 格式化结果
     * @param $content string
     * @return mixed
     */
    protected function proccessResult($content)
    {
        return json_decode(mb_convert_encoding($content, 'UTF8', 'GBK'), true, 512, JSON_BIGINT_AS_STRING);
    }

    public function auth()
    {
        // TODO: Implement GetAccessToken() method.
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
        $data['text'] = $text;
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');
        $client = new Client(self::BaiduDomain,443,true);
        $client->post('/rpc/2.0/nlp/v1/lexer?access_token='.$this->config['baidu']['access_token'],$data);
        return $this->proccessResult($client->getBody());
    }

    /**
     * @param string $text 文本内容，最大256字节，不需要切词
     * @return mixed
     */
    public function dnnlmCn($text)
    {
        // TODO: Implement dnnlmCn() method.
        $data['text'] =$text;
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');
        $client = new Client(self::BaiduDomain,443,true);
        $client->post('/rpc/2.0/nlp/v2/dnnlm_cn?access_token='.$this->config['baidu']['access_token'],$data);
        return $this->proccessResult($client->getBody());
    }


    public function keyword($title,$text)
    {
        // TODO: Implement keyword() method.
        $data['title'] = $title;
        $data['content'] = $text;
        $data = mb_convert_encoding(json_encode($data),'GBK','UTF8');
        $client = new Client(self::BaiduDomain,443,true);
        $client->post('/rpc/2.0/nlp/v1/keyword?access_token='.$this->config['baidu']['access_token'],$data);
        return $this->proccessResult($client->getBody());
    }

    public function topic($title,$text)
    {
        // TODO: Implement topic() method.
        $data['title'] = $title;
        $data['content'] = $text;
        $data = mb_convert_encoding(json_encode($data),'GBK','UTF8');
        $client = new Client(self::BaiduDomain,443,true);
        $client->post('/rpc/2.0/nlp/v1/topic?access_token='.$this->config['baidu']['access_token'],$data);
        return $this->proccessResult($client->getBody());
    }

    public function ecnet($text)
    {
        // TODO: Implement ecnet() method.
        $data['text'] = $text;
        $data = mb_convert_encoding(json_encode($data),'GBK','UTF8');
        $client = new Client(self::BaiduDomain,443,true);
        $client->post('/rpc/2.0/nlp/v1/ecnet?access_token='.$this->config['baidu']['access_token'],$data);
        return $this->proccessResult($client->getBody());
    }

    public function summary($title,$text)
    {
        // TODO: Implement summary() method.
        $data['title'] = $title;
        $data['text'] = $text;
        $data = mb_convert_encoding(json_encode($data),'GBK','UTF8');
        $client = new Client(self::BaiduDomain,443,true);
        $client->post('/rpc/2.0/nlp/v1/news_summary?access_token='.$this->config['baidu']['access_token'],$data);
        return $this->proccessResult($client->getBody());
    }
}