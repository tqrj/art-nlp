<?php


namespace nlp;

interface NlpInterface
{

    public function auth();

    /**
     * 词法分析
     * @param $text
     * @return mixed
     */
    public function lexer($text);

    /**
     * 文章标签
     * @param $title
     * @param $text
     * @return mixed
     */
    public function keyword($title,$text);

    /**
     * 文章分类
     * @param string $title
     * @param string $text
     * @return mixed
     */
    public function topic($title,$text);

    /**
     * 文本纠错
     * @param string $text
     * @return mixed
     */
    public function ecnet($text);

    /**
     * 新闻摘要
     * @param string $title
     * @param string $text
     * @return mixed
     */
    public function summary($title,$text);

}