<?php

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';


/**
 * 导入单个 sql 文件到数据库
 *
 * @param string $sqlFile
 */
function importSql(string $sqlFile)
{
    $x = new jxdsp\Mysql\Mysql();

    $sql = file_get_contents($sqlFile);

    $_arr = explode(';', $sql);

    foreach ($_arr as $value) {
        if (empty($value)) {
            continue;
        }

        try {
            $x->query($value);
        } catch (Exception $e) {
            $errorMsg = [
                'msg' => $e->getMessage()
            ];
            echo json_encode($errorMsg, JSON_UNESCAPED_UNICODE);
        }
    }
}

/**
 * @param string $dir
 *
 * @return array
 */
function getFilesName(string $dir): array
{
    //首先先读取文件夹
    $result = [];
    $temp   = scandir($dir);

    foreach ($temp as $v) {
        $a = $dir . '/' . $v;
        if (!is_dir($a)) {
            $result[] = $v;
        }
    }

    return $result;
}

/**
 * @param string $sqlDir
 *
 * @return bool
 */
function importSqlDir(string $sqlDir): bool
{
    $sqlFiles = getFilesName($sqlDir);

    foreach ($sqlFiles as $fileName) {
        echo '<br>';
        importSql($sqlDir . '/' . $fileName);
    }
    return true;
}
