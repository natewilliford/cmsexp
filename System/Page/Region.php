<?php 

class Page_Region implements Renderable {
    
    private $_name;
    
    private $_renderables = array();
    
    function __construct($name) {
        $this->_name = $name;
    }
    
    public function getName() {
        return $this->_name;
    }
    
    public function render() {
        // Start recording the output stream, render all the renderables, then return the rendered string
        $content = '';
        foreach($this->_renderables as $renderable) {
            $content .= $renderable->render();
        }
        return $content;
    }
    
    public function addRenderable(Renderable $renderable) {
        $this->_renderables[] = $renderable;
    }
    
    public function __toString() {
        return $this->render();
    }
    
}