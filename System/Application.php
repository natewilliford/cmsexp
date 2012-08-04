<?php 

class Application {
    
    private static $_appPath;
    public static $layoutTemplate;
    
    private static $_mongo;
    private static $_contentDb;
    private static $_structureDb;
    
    public static function setAppPath($appPath) {
        self::$_appPath = $appPath;
    }
    
    public static function getAppPath() {
        return self::$_appPath;
    }
    
    private static function getMongo() {
        if (!self::$_mongo) {
            self::$_mongo = new Mongo();
        }
        return self::$_mongo; 
    }
    
    public static function getContentDb() {
        if (!self::$_contentDb) {
            // todo: make configurable
            self::$_contentDb = self::getMongo()->cms_content;
        }
        return self::$_contentDb;
    }
    
    public static function getStructureDb() {
        if (!self::$_structureDb) {
            // todo: make configurable
            self::$_structureDb = self::getMongo()->cms_structure;
        }
        return self::$_structureDb;
    }
    
    public static function route($uri) {
        
        self::_loadModules();
        Hook::trigger(__CLASS__, 'preDispatch', array('uri' => $uri));
        
        $parsed = parse_url($uri);
        $parts = explode('/', substr($parsed['path'], 1));
        
        Controller::route($parts);
        
        
//        $routeName = str_replace('/', '_', substr($parsed['path'], 1));
        
//        print_r($routeName); exit;
//        
//        print_r($_GET); exit;

        switch ($parts[0]) {
            case 'page':
                self::routePage($parts);
                break;
        }
    }
    
    private static function _routePage($uriParts) {
        
    }
    
    private static function _loadModules() {
        $modulePath = Config::getModulePath();
        
        $directories = scandir($modulePath);
        
        foreach($directories as $d) {
            if (substr($d, 0, 1) != '.') {
                if (is_dir($modulePath . DIRECTORY_SEPARATOR . $d)) {
                    $moduleClass = 'Module_'.$d;
                    if (method_exists($moduleClass, 'load')) {
                        $moduleClass::load();
                    }
                    // May at some point want to put some error handling when there are problems loading modules
                }
            }
        }
    }
    
}