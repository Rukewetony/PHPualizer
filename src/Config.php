<?php
namespace PHPualizer;


class Config
{
    private static $m_CfgArray;

    public static function getConfigData(): array
    {
        if(isset(self::$m_CfgArray)) {
            return self::$m_CfgArray;
        } else {
            $f_stream = fopen(dirname(__DIR__) . '/config.json', 'r') or die('Couldn\'t read config file');
            $cfg_string = fread($f_stream, filesize(dirname(__DIR__) . '/config.json'));
            fclose($f_stream);

            self::$m_CfgArray = json_decode($cfg_string, true);

            if(self::$m_CfgArray != null)
                return self::$m_CfgArray;
            else
                throw new \Exception('The config file either contains no keys, or has invalid JSON');
        }
    }
    
    public static function getVersion(): string
    {
        $f_stream = fopen(dirname(__DIR__) . '/VERSION', 'r') or die('Couldn\'t load VERSION file!');
        $version = fread($f_stream, filesize(dirname(__DIR__) . '/VERSION'));
        fclose($f_stream);

        return $version;
    }
}