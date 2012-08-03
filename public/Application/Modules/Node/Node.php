<?php 

class Module_Node extends ModuleAbstract {
    public static function install() {
        
    }
    
    public static function load() {
        Hook::listen('Application', new Module_Node_Listener_Application());
        Controller::register('node', new Module_Node_Controller_Node());
    }
    
    
    public static function uninstall() {
        
    }
    
}
