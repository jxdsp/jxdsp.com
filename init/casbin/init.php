<?php

require_once dirname(__FILE__) . '/userGroup.php';


/**
 * 初始化组的解析权限
 */
function initGroupPermissions()
{
    global $userPermission, $obj, $act;
    $casbinEn = new jxdsp\Casbin\CasbinEnforcer;

    foreach ($userPermission as $user => $userValue) {
        foreach ($userValue as $type => $typeValue) {
            for ($i = 0; $i < count($typeValue); $i++) {
                if ($typeValue[$i] === true) {
                    $casbinEn->addPermissionForUser($user, $type . '_' . $obj[$type][$i], $act[$type][0]);
                }
            }
        }
    }
}
