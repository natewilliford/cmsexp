<?php 

abstract class MongoObject {
    
    protected static $_collectionName;
    
//    protected static $_collection;
    
    protected $_data;
    
    protected function __construct($data) {
        $this->_data = $data;
    }
    
    public function __set($name, $value) {
        $this->_data[$name] = $value;
    }
    
    public function __get($name) {
        return $this->_data[$name];
    }
    
    protected static function _getCollection() {
        if (!static::$_collectionName) {
            throw new MongoObject_Exception('You must define a collection name in your overriding class. e.g. protected static $_collectionName = \'my_collection\';');
        }
        return static::_getDb()->{static::$_collectionName};
    }
    
    protected static function _getDb() {
        return Application::getContentDb();
    }
    
    public static function create($data) {
        static::_create($data);
        return new static($data);
    }
    
    protected static function _create($data) {
        static::_getCollection()->insert($data, array('safe' => true));
        return $data;
    }
    
    protected function _save() {
        static::_getCollection()->update(array('_id' => $this->_data['_id']), $this->_data);
    } 
    
    public static function getOne($id) {
        $data = static::_getOne($id);
        if ($data) {
            return new static($data);
        }
        return;
    }
    
    protected static function _getOne($id) {
        if (!($id instanceof MongoId)) {
            $id = new MongoId($id);
        }
        
        return static::_getCollection()->findOne(array('_id' => $id));
    }
    
    public function delete() {
        return static::_getCollection()->remove(array('_id' => $this->_data['_id']));
    }
}