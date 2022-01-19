<?php


namespace jxdsp\Captcha;

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use jxdsp\Captcha\Traits\CaptchaTraits;
use jxdsp\Captcha\Traits\OutputTraits;

class Captcha extends CaptchaBuilder
{
    use CaptchaTraits, OutputTraits;

    /**
     * @var PhraseBuilder
     */
    protected PhraseBuilder $PhraseBuilder;

    /**
     * @param int|array|null $length 验证码字符位数
     * @param string|null $charset 验证码字符库
     */
    public function __construct($length = null, string $charset = null)
    {
        if (is_array($length)) {
            foreach ($length as $key => $value) {
                $$key = $value;
            }
        }

        $this->PhraseBuilderConfig($length, $charset);
        $this->PhraseBuilder = new PhraseBuilder($this->length, $this->charset);
        parent::__construct(null, $this->PhraseBuilder);
    }

    public function __destruct()
    {
    }
}
