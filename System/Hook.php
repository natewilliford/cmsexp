<?php 

class Hook {
    
    private static $_listeners = array();
    
    public static function trigger($className, $hookName, $params = array(), &$return = array()) {
        if (isset(self::$_listeners[$className])) {
            foreach(self::$_listeners[$className] as $listener) {
                if (method_exists($listener, $hookName)) {
                    $listener->$hookName($params, $return);
                }
            }
        }
    }
    
    public static function listen($className, $hookListener) {
        self::$_listeners[$className][] = $hookListener;
    }
}