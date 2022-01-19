<?php

namespace jxdsp\Mail\Traits;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\RawMessage;

trait TemplatedEmailTrait
{
    /**
     * @param array|string $to 优先使用数组形式较为方便，后面的参数只是形参列表，方便参考
     * @param string|null  $subject
     * @param string|null  $htmlTemplate
     * @param array|null   $context
     * @param string|null  $priority
     * @param string|null  $from
     * @param string|null  $replyTo
     * @param string|null  $cc
     * @param string|null  $bcc
     *
     * @return TemplatedEmail|RawMessage
     */
    protected function templatedEmail($to, string $subject = null, string $htmlTemplate = null, array $context = null, string $priority = null, string $from = null, string $replyTo = null, string $cc = null, string $bcc = null)
    {
        if (is_array($to)) {
            foreach ($to as $key => $value) {
                $$key = $value;
            }
        }

        return (new TemplatedEmail())
            ->from($from)
            ->to(new Address($to))
            ->replyTo($replyTo)
//            ->cc($cc)
//            ->bcc($bcc)
            ->priority($priority)
            ->subject($subject)
            ->htmlTemplate($htmlTemplate)
            ->context($context);
    }

    public function registerEmail(string $to, string $username)
    {
        $context = [
            'username'        => $username,
            'active'          => 'https://www.test.com',
            'expiration_date' => date('Y-m-d H:i:s', time() + 60 * 5),
            'siteInfo'        => [
                'name'  => $this->siteInfo['name'],
                'url'   => $this->siteInfo['url'],
                'email' => $this->siteInfo['email'],
            ],
        ];
        $mailInfo = [
            'to'           => $to,
            'subject'      => '新用户注册确认',
            'htmlTemplate' => 'signUp.html.twig',
            'context'      => $context,
            'priority'     => $this->mail_priority,
            'from'         => $this->mail_from_address,
            'replyTo'      => $this->mail_reply_to_address,
            //            'cc'              => $this->mail_cc_address,
            //            'bcc'             => $this->mail_bcc_address,
        ];
        $this->email = $this->templatedEmail($mailInfo);
        $this->sendEmail();
    }
}
