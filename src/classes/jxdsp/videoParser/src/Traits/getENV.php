<?php


namespace jxdsp\VideoParser\Traits;


trait getENV
{
//    短视频相关
    public function getShortVideoParserAppId(): string
    {
        return (string)$_ENV['VideoParseCn_AppId'];
    }

    public function getShortVideoParserAppSecret(): string
    {
        return (string)$_ENV['VideoParseCn_AppSecret'];
    }

    public function getShortVideoParserApiUrl(string $parseType = 'safe'): string
    {
        $ApiUrl = '';
        if ($parseType === 'safe') {
            $ApiUrl = (string)$_ENV['VideoParseCn_Safe_parse'];
        } elseif ($parseType === 'custom') {
            $ApiUrl = (string)$_ENV['VideoParseCn_Custom_parse'];
        }
        return $ApiUrl;
    }

    public function getShortVideoGetAuthorInfoApiUrl(string $parseType = 'safe'): string
    {
        $ApiUrl = '';
        if ($parseType === 'safe') {
            $ApiUrl = (string)$_ENV['VideoParseCn_Safe_getAuthorInfo'];
        } elseif ($parseType === 'custom') {
            $ApiUrl = (string)$_ENV['VideoParseCn_Custom_getAuthorInfo'];
        }
        return $ApiUrl;
    }

    public function getShortVideoGetListApiUrl(string $parseType = 'safe'): string
    {
        $ApiUrl = '';
        if ($parseType === 'safe') {
            $ApiUrl = (string)$_ENV['VideoParseCn_Safe_getList'];
        } elseif ($parseType === 'custom') {
            $ApiUrl = (string)$_ENV['VideoParseCn_Custom_getList'];
        }
        return $ApiUrl;
    }

    public function getShortVideoGetLikeListApiUrl(string $parseType = 'safe'): string
    {
        $ApiUrl = '';
        if ($parseType === 'safe') {
            $ApiUrl = (string)$_ENV['VideoParseCn_Safe_getLikeList'];
        } elseif ($parseType === 'custom') {
            $ApiUrl = (string)$_ENV['VideoParseCn_Custom_getLikeList'];
        }
        return $ApiUrl;
    }

//    时间戳
    public function getTimestamp(): int
    {
        return (int)time();
    }

//    长视频相关
    public function getLongVideoParserAppId(): string
    {
        return (string)$_ENV['ParseVideoCom_AppId'];
    }

    public function getLongVideoParserAppSecret(): string
    {
        return (string)$_ENV['ParseVideoCom_AppSecret'];
    }

    public function getLongVideoParserApiUrl(string $parseType = 'normal'): string
    {
        $ApiUrl = '';
        if ($parseType === 'safe') {
            $ApiUrl = (string)$_ENV['ParseVideoCom_Normal_Parse'];
        } elseif ($parseType === 'custom') {
            $ApiUrl = (string)$_ENV['ParseVideoCom_Sign_Parse'];
        }
        return $ApiUrl;    }
}
