<?php 

class Page implements Renderable {
    
//    protected static $_collectionName = 'page';
    
    private $_renderables = array();

    private $_layoutTemplate;
    
    public function render() {
//        $content = '';
        
//        ob_start();
//        include Template::getTemplate(get_class($this));
//        $content = ob_get_clean();
        include Template::getTemplate('Layouts'. DIRECTORY_SEPARATOR . $this->getLayoutTemplate());
    }
    
    public function addRenderable($name, $renderable) {
        $this->_renderables[$name] = $renderable;
    }
    
    function __get($name) {
        if (isset($this->_renderables[$name])) {
            return $this->_renderables[$name];
        }
    }
    
    public function setLayoutTemplate($layoutTemplate) { 
        $this->_layoutTemplate = $layoutTemplate;
    }
    
    public function getLayoutTemplate() {
        if ($this->_layoutTemplate) {
            return $this->_layoutTemplate;
        } else {
            return Config::getDefaultLayoutTemplate();
        }
    }
    
    protected static function _getDb() {
        return Application::getStructureDb();
    }
    
}