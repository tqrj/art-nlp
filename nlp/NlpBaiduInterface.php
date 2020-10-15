<?php


namespace nlp;


interface NlpBaiduInterface
{
    const BaiduDomain = '';

    public function dnnlmCn($text);

}