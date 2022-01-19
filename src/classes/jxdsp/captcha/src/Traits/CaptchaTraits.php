<?php

namespace jxdsp\Captcha\Traits;

trait CaptchaTraits
{

    /**
     * @var int 短语长度
     */
    protected int $length;

    /**
     * @var string 短语字符集
     */
    protected string $charset;

    /**
     * @param int|null $length
     * @param string|null $charset
     */
    public function PhraseBuilderConfig(int $length = null, string $charset = null): void
    {
        $this->setLength($length ?? mt_rand(4, 5));
        $this->setcharset($charset ?? '23456789ABCDEFGHJKLMNPQRSTUVWXYZ');
    }

    /**
     * @param int $length
     */
    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param string $charset
     */
    public function setCharset(string $charset): void
    {
        $this->charset = $charset;
    }

}
