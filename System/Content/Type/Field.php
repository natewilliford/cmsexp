<?php 

class Content_Type_Field {
    
    const FIELD_REQUIRED    = 1;
    const FIELD_INDEX       = 2;
    const FIELD_UNIQUE      = 4;
    
    private $_type;
    
    function __construct($type) {
        $this->_type = $type;
    }
}