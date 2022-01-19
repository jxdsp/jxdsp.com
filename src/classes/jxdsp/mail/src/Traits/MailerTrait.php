<?php

namespace jxdsp\Mail\Traits;

use Symfony\Component\Mailer\Mailer;

trait MailerTrait
{

    public function mailer(): Mailer
    {
        return new Mailer(self::TransportFromDsn());
    }

}
