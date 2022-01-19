<?php


namespace jxdsp\Captcha;

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use jxdsp\Captcha\Traits\OutputTraits;

class NumberCaptcha extends CaptchaBuilder
{
    use OutputTraits;

    /**
     * @var PhraseBuilder
     */
    protected PhraseBuilder $PhraseBuilder;

    /**
     * @param int|array|null $length 验证码字符位数
     */
    public function __construct($length = null)
    {
        $this->PhraseBuilder = new PhraseBuilder($length, '0123456789');
        parent::__construct(null, $this->PhraseBuilder);
    }

    public function __destruct()
    {
    }
}
