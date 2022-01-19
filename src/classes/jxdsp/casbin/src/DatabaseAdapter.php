<?php

namespace jxdsp\Casbin;

use CasbinAdapter\Database\Adapter;

class DatabaseAdapter extends Adapter
{
    public $casbinRuleTableName = 'user_casbin_rule';
}
