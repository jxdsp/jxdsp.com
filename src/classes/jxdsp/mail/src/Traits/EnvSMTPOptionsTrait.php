<?php

namespace jxdsp\Mail\Traits;

use jxdsp\Env\LoadEnv;

trait EnvSMTPOptionsTrait
{

    /**
     * @var string
     */
    public string $smtp_user;
    /**
     * @var string
     */
    public string $smtp_pass;

    /**
     * @var string
     */
    public string $smtp_url;

    /**
     * @var string
     */
    public string $smtp_port;


    public function loadSMTP()
    {
        new LoadEnv();

        $this->smtp_user = $_ENV['MAIL_SMTP_USERNAME'];
        $this->smtp_pass = urlencode($_ENV['MAIL_SMTP_PASSWORD']);
        $this->smtp_url = $_ENV['MAIL_SMTP_HOST'];
        $this->smtp_port = $_ENV['MAIL_SMTP_PORT'];
    }

}
