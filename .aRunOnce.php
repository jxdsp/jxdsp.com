<?php

if (!file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    exit('先通过 composer 安装依赖组件，然后在运行本初始化工具。');
}

require_once dirname(__FILE__) . '/vendor/autoload.php';

// 导入数据库
require_once dirname(__FILE__) . '/init/database/init.php';
importSqlDir(dirname(__FILE__) . '/database defs');


// 初始化组权限
require_once dirname(__FILE__) . '/init/casbin/init.php';
initGroupPermissions();


echo '初始化完成，将会自动删除本初始化工具，以防错误操作。';
unlink(dirname(__FILE__) . '/' . basename(__FILE__));
