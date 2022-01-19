<?php

/**
 * @param string $Context
 */
function custom_header_404($Context = 'No input file specified.')
{
    header('HTTP/1.1 404 Not Found');
    exit($Context);
}

/**
 * 获取服务器的站点域名
 *
 * @return string
 *
 * @throws InvalidArgumentException
 */
function getWebsiteURL(): string
{
    $REQUEST_SCHEME = $_SERVER['REQUEST_SCHEME'];
    $SERVER_NAME    = $_SERVER['SERVER_NAME'];
    $HTTP_HOST      = $_SERVER['HTTP_HOST'];

    if ($SERVER_NAME !== $HTTP_HOST) throw new InvalidArgumentException("获取服务器的站点域名出错");

    $domain = $HTTP_HOST;

    return $REQUEST_SCHEME . '://' . $domain;
}

/**
 * @return string
 */
function getIp(): string
{
    $field = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR',
    ];
    foreach ($field as $key) {
        if (array_key_exists($key, $_SERVER)) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                $ip = trim($ip);
                //会过滤掉保留地址和私有地址段的IP，例如 127.0.0.1会被过滤
                //也可以修改成正则验证IP
                if ((bool)filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE)) {
                    return (string)$ip;
                }
            }
        }
    }
    return 'unknown';
}

/**
 * @return string
 */
function get_user_agent(): string
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?: '';
    if ('' === $user_agent) {
        $user_agent = 'nullValue';
    } elseif (strlen($user_agent) >= 380) {
        $user_agent = 'DataIsTooLong=== ' . $user_agent;
    }
    return (string)$user_agent;
}
