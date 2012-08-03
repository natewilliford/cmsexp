<?php 

class Controller {
    
    const DEFAULT_CONTROLLER = 'index';
    const DEFAULT_ACTION = 'index';
    
    private static $_namespaces = array();
    
    public static function route($urlParts) {
        $namespace = $urlParts[0];
        
        if (empty($namespace)) {
            $namespace = self::DEFAULT_CONTROLLER;
        }
        
        if (sizeof($urlParts) >= 2) {
            $action = $urlParts[1];
        } else {
            $action = self::DEFAULT_ACTION;
        }
        
        
        if (isset(self::$_namespaces[$namespace])) {
            if (method_exists(self::$_namespaces[$namespace], $action)) {
                self::$_namespaces[$namespace]->$action($urlParts);
            }
            else {
                throw new Content_Exception('No action '.$action.' defined for namespace '.$namespace.'.');
            }
        }
        else {
            throw new Content_Exception('No namespace '.$namespace.' registered.');
        }
    }
    
    public static function register($namespace, $controller) {
        if (isset(self::$_namespaces[$namespace])) {
            throw new Controller_Exception('Namespace '.$namespace.' already registered.', Controller_Exception::CODE_DUP_NAMESPACE);
        }
        self::$_namespaces[$namespace] = $controller;
    }
}