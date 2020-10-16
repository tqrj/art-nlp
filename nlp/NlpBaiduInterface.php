<?php


namespace nlp;


interface NlpBaiduInterface
{
    const BaiduDomain = 'aip.baidubce.com';

    /**
     * dnn模型
     * @param $text
     * @return mixed
     */
    public function dnnlmCn($text);

}