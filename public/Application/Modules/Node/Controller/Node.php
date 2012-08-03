<?php 

class Module_Node_Controller_Node {
    
    public function index() {
        print_r('routed to node controller, index action'); exit;
    }
    
    public function customaction($urlParts) {
//        print_r('routed to node controller, customaction'); exit;
        print_r($urlParts); exit;

    }
}