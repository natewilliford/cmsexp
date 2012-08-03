<?php 

class Module_App_Controller_Index {
    function index($urlParts) {
//        print_r($urlParts); exit;
        $page = new Page();

        $content = Content::getAll('post');
        $page->addRenderable('content', $content);
        
        $page->render();
    }
}