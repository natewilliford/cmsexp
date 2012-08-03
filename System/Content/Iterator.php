<?php 

class Content_Iterator implements Iterator, Renderable {
    
    private $_data;
    private $_type;
    
    function __construct($type, $data) { 
        $this->_type = $type;
        $this->_data = $data;
    }
    
    public function current () {
        return new Content($this->_type, $this->_data->current());
    }
    
    public function key () {
        return $this->_data->key();
    }
    
    public function next () {
        $this->_data->next();
    }
    
    public function rewind () {
        $this->_data->rewind();
    }
    
    public function valid () {
        return $this->_data->valid();
    }
    
    public function render() {
//        $content = '';
//        foreach($this as $item) {
//            $content .= $item->render();
//        }
        ob_start();
        include Template::getTemplate(get_class($this));
        return ob_get_clean();
    }
    
    public function __toString() {
        return $this->render();
    }
    
}