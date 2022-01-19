<?php

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

require_once dirname(__FILE__) . '/filters.php';

require_once dirname(__FILE__) . '/database/history/query_history.php';
require_once dirname(__FILE__) . '/database/times/query_times.php';

$result = [];

// 分流s,m,l解析
global $videoType;
switch ($videoType) {
    case 's':
        require_once dirname(__FILE__) . '/VideoParseCn/safeParseConfig.php';
        break;
    case 'l':
        require_once dirname(__FILE__) . '/ParseVideoCom/normalParseConfig.php';
        break;
    case 'm':
        $errorResult = [
            'msg' => '此格式暂未启用'
        ];
        exit(json_encode($errorResult, JSON_UNESCAPED_UNICODE));
//        break;
    default:
        $errorResult = [
            'msg' => '未知参数选项'
        ];
        exit(json_encode($errorResult, JSON_UNESCAPED_UNICODE));
//        break;
}

//require_once dirname(__DIR__, 2) . "/curl/curl_get.php";
require_once dirname(__DIR__, 2) . "/curl/curl_post.php";

global $CurlResult;

$result = $CurlResult;


require_once dirname(__FILE__) . '/database/insert.php';
