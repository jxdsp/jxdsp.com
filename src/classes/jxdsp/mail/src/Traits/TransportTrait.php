<?php

namespace jxdsp\Mail\Traits;

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Transport\TransportInterface;

trait TransportTrait
{

    public function TransportFromDsn(): TransportInterface
    {
        return Transport::fromDsn("smtp://$this->smtp_user:$this->smtp_pass@$this->smtp_url:$this->smtp_port");
    }

    public function TransportFromDsns(): TransportInterface
    {
        $dsns = ["smtp://$this->smtp_user:$this->smtp_pass@$this->smtp_url:$this->smtp_port"];
        return Transport::fromDsns($dsns);
    }

}
