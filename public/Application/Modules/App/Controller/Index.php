<?php 

class Module_App_Controller_Index {
    function index($urlParts) {

        $page = new Page();

        $content = Content::getAll('post');
        $page->addRenderable('content', $content);

        $page->render();
    }
}