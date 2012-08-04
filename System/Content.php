<?php 

class Content extends MongoObject implements Renderable {
    
    private $_type;
    
    public function __construct($type, $data) {
        $this->_type = $type;
        parent::__construct($data);
    }
    
    public function render() {
        ob_start();
        include Template::getTemplate($this->_type->name);
        return ob_get_clean();
    }
    
    public static function create($type, $data){
        $type = static::_setStaticContentType($type);
        $data = $type->transformData($data);

        $data = static::_create($data);
        return new self($type, $data);
    }
    
    public static function getOne($type, $id) {
        $type = self::_setStaticContentType($type);
        $data = static::_getOne($id);
        return new static ($type, $data);
    }
    
    public static function getAll($type) {
        $type = self::_setStaticContentType($type);
        $collection = static::_getCollection();
        $data = $collection->find();
        return new Content_Iterator($type, $data);
    }
    
    public function getId() {
        return $this->_data->_id;
    }
    
    public function __get($name) { 
        if (isset($this->_data[$name])) {
            return $this->_data[$name];
        }
    }
    
    private static function _setStaticContentType($type) {
        if (!($type instanceof Content_Type)) {
            $type = Content_Type::getByName($type);
        }
        static::$_collectionName = $type->name;
        return $type;
    }
    
    public function save() {
        $this->_save();
    }
    
    public function __toString() {
        return $this->render();
    }
    
}