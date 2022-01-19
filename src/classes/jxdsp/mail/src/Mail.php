<?php

namespace jxdsp\Mail;


use jxdsp\Mail\Traits\EnvEmailOptionsTrait;
use jxdsp\Mail\Traits\EnvSiteTrait;
use jxdsp\Mail\Traits\EnvSMTPOptionsTrait;
use jxdsp\Mail\Traits\MailerTrait;
use jxdsp\Mail\Traits\TemplatedEmailTrait;
use jxdsp\Mail\Traits\TransportTrait;
use jxdsp\Mail\Traits\TwigTrait;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Message;
use Symfony\Component\Mime\RawMessage;


class Mail
{
    use EnvEmailOptionsTrait;
    use EnvSiteTrait;
    use EnvSMTPOptionsTrait;
    use MailerTrait;
    use TemplatedEmailTrait;
    use TransportTrait;
    use TwigTrait;

    /**
     * @var Message|RawMessage
     */
    public $email;

    public function __construct()
    {
        $this->loadSMTP();
        $this->loadEmailOptions();
        $this->loadSiteInfo();
    }

    public function sendEmail()
    {

        $mailer = $this->mailer();

        $this->twigBodyRenderer($this->email);

        try {
            $mailer->send($this->email);
        } catch (TransportExceptionInterface $e) {
            echo $e->getMessage();
        }
    }

}
