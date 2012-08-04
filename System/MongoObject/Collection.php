<?php 

abstract class MongoObject_Collection {
    
    protected static $_collectionName;
    
    protected static $_collection;
    

    
    public function create($data) {
        return $this->_getCollection()->insert($data);
    }
    
    public function save($data) {
        $this->_getCollection()->update(array('_id' => $this->_data['_id']), $this->_data);
    }
    
}