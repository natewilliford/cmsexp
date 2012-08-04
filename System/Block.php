<?php 

class Block extends MongoObject implements Renderable {
    
    private $_renderable;
    
    public function setRenderable(Renderable $renderable) {
        $this->_renderable = $renderable;
    }
    
    public function render() {
        return $this->_renderable->render();
    }
    
    public function __toString() {
        return $this->render();
    }
    
}