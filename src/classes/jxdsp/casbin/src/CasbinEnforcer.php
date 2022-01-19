<?php

namespace jxdsp\Casbin;


use Casbin\Enforcer;
use jxdsp\Casbin\Traits\DbConfigTrait;

class CasbinEnforcer extends Enforcer
{
    use DbConfigTrait;

    public function __construct()
    {
        $this->setDbConfig();

        parent::__construct(dirname(__FILE__) . '/conf/rbac_model.conf', DatabaseAdapter::newAdapter($this->getDbConfig()));
    }
}
