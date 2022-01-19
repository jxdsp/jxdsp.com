<?php

namespace jxdsp\Mail\Traits;

use jxdsp\Env\LoadEnv;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

trait EnvEmailOptionsTrait
{

    /**
     * @var string
     */
    public string $mail_from_address;

    /**
     * @var string
     */
    public string $mail_reply_to_address;

    /**
     * @var string
     */
    public string $mail_from_name;

    /**
     * @var string
     */
    public string $mail_cc_address;

    /**
     * @var string
     */
    public string $mail_bcc_address;

    /**
     * @var string
     */
    public string $mail_priority;


    public function loadEmailOptions()
    {
        new LoadEnv();

        $this->mail_from_address = $_ENV['MAIL_SMTP_FROM_ADDRESS'];
        $this->mail_reply_to_address = $_ENV['MAIL_SMTP_REPLY_TO_ADDRESS'];
        $this->mail_from_name = $_ENV['MAIL_SMTP_FROM_NAME'];
        $this->mail_priority = $_ENV['MAIL_SMTP_PRIORITY'] ?? Email::PRIORITY_HIGH;
        $this->mail_cc_address = $_ENV['MAIL_SMTP_BCC_ADDRESS'] ?? '';
        $this->mail_bcc_address = $_ENV['MAIL_SMTP_BCC_ADDRESS'] ?? '';
    }
}
