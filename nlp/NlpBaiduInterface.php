<?php


namespace nlp;


interface NlpBaiduInterface
{
    const BaiduDomain = 'aip.baidubce.com';

    public function dnnlmCn($text);

}