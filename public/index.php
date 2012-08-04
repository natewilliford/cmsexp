<?php


//print_r($_SERVER); exit;

require_once '../Bootstrap.php';

Config::setDocumentRoot('/Users/nathan/Projects/Sites/cmsexp');

//class MyHook implements Application_Hook {
//    
//    public function preDispatch() {
//        print_r('pre dispatch'); exit; 
//    }
//    
//    public function postDispatch() {
//        
//    }
//}
//Application::setHookListenner(new MyHook());
Application::route($_SERVER['REQUEST_URI']);
//

//$type = Content_Type::create('page');
//$type->addField('title');
//$type->addField('body');
//$type->save();

//$type = Content_Type::getByName('post');
//$type = Content_Type::getOne('4e1e099833f1f74a22000000');

//$type->delete(); exit;

//$type->removeField('author');
//print_r($type); exit;

//$content = Content::create('post', array('title' => 'This is a test post', 'body' => 'Lorem ipsum dolor', 'someotherfield' => 'derp2'));

//$content = Content::getOne('post', '4e345b5833f1f7f11d020000');

//print_r($content); exit;

//echo Content::getOne('post', '4e34596833f1f7f51d010000')->render(); exit;

//$page = new Page('main');

//$block = new Block();
//$block->setRenderable(Content::getOne('post', '4e34596833f1f7f51d010000'));
//$page->addBlock('left', $block);
//
//
//
//$block = new Block();
//$block->setRenderable(Content::getAll('post'));
//$page->addBlock('center', $block);

