<?php 

class Config {
    private static $_documentRoot; 
    private static $_applicationDirectory = 'public/Application';
    private static $_templateDirectory = 'Templates';
    private static $_moduleDirectory = 'Modules';
    private static $_defaultLayoutTemplate = 'main';
    
    public static function setDocumentRoot($documentRoot) {
        self::$_documentRoot = $documentRoot;
    }
    
    public static function getApplicationPath() {
        return self::$_documentRoot . DIRECTORY_SEPARATOR . self::$_applicationDirectory;
    }
    
    public static function getTemplatePath() {
        return self::getApplicationPath() . DIRECTORY_SEPARATOR . self::$_templateDirectory;
    }
    
    public static function getModulePath() {
        return self::getApplicationPath() . DIRECTORY_SEPARATOR . self::$_moduleDirectory;
    }
    
    public static function setDefaultLayoutTemplate($layoutTemplate) {
        $_defaultLayoutTemplate = $layoutTemplate;
    }
    
    public static function getDefaultLayoutTemplate() {
        return self::$_defaultLayoutTemplate; 
    }
}