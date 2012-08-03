<?php 

class Module_App extends ModuleAbstract {
    public static function install() {
    }
    
    public static function load() {
        
        Controller::register('index', new Module_App_Controller_Index());
        
    }
    
    public static function uninstall() {}
}