<?php
/**
 * 检查所需的最低PHP版本或者PHP扩展包的版本
 *
 * @param string $minimumVersion 最低版本号
 *
 * @param string|null $extensionName [optional] 可选的扩展包名称
 *
 * @return bool 当前运行的版本低于$minimumVersion的时候，停止运行并且提示相关信息。运行的版本不低于$minimumVersion的时候，将返回true。
 */
function minimum_version_required(string $minimumVersion, string $extensionName = null): bool
{
    $current_version = phpversion($extensionName) ? phpversion($extensionName) : phpversion();

    if (version_compare($current_version, $minimumVersion, '<')) {
        if (null === $extensionName) {
            $tips = printf('PHP的版本需要不低于 %s ，当前PHP的版本为 %s', $minimumVersion, $current_version);
        } else {
            $tips = printf('PHP扩展【 %s 】的版本需要不低于 %s ，当前的PHP扩展【 %s 】的版本为 %s', $extensionName, $minimumVersion, $extensionName, $current_version);
        }
        exit($tips);
    }

    return true;
}
