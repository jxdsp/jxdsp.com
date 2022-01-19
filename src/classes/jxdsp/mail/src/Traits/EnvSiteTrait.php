<?php

namespace jxdsp\Mail\Traits;

trait EnvSiteTrait
{
    /**
     * @var array
     */
    public array $siteInfo;

    public function loadSiteInfo()
    {
        $this->siteInfo['name'] = $_ENV['EMAIL_SITE_NAME'];
        $this->siteInfo['email'] = $_ENV['EMAIL_SITE_EMAIL'];
        $this->siteInfo['url'] = $_ENV['EMAIL_SITE_URL'];
    }

}
