<?php

namespace Core;

class Config {

    private static $_isInit = false;
    /**
     * @var self
     */
    private static $_instance;
    private $configs = [];

    private function __construct()
    {
        $this->loadConfigs();
    }

    private function __clone()
    {

    }

    public static function getInstance() {
        if(!self::$_instance instanceof Config) {
            self::$_instance = new self();
            self::$_isInit = true;
        }

        return self::$_instance;
    }

    public static function load($stringReturn = null) {
        if(self::$_isInit == false) {
            self::getInstance();
        }
        $result = self::$_instance->getConfig();
        if(!$stringReturn) {
            return $result;
        }

        $listsKeysGet = explode('.', $stringReturn);
        $listReturn = [];
        while ($keyGet = array_shift($listsKeysGet)) {
            if(array_key_exists($keyGet, $result)) {
                $listReturn = $result[$keyGet];
                continue;
            }

            if(array_key_exists($keyGet, $listReturn)) {
                $listReturn = $listReturn[$keyGet];
                continue;
            }
        }

        return $listReturn;
    }

    public function getConfig() {
        return $this->configs;
    }

    /**
     * load files from config app dir.
     */
    private function loadConfigs() {
        if(is_dir(CONFIG_PATH)) {
            $lists = scandir(CONFIG_PATH);
            if(count($lists) > 2) {
                unset($lists[array_search('.', $lists)]);
                unset($lists[array_search('..', $lists)]);

                $fileNames = array_map(function($fileName) {
                    return str_replace('.php', null, $fileName);
                }, $lists);
                $contentConfigs = array_map(function($fileName) {
                    return include CONFIG_PATH.$fileName;
                }, $lists);
                $this->configs = array_combine($fileNames, $contentConfigs);
            }
        }
    }
}