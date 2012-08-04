<?php

class Content_Type extends MongoObject {
    
    const FLAG_IMMUTABLE = 1;
    const FLAG_INVISIBLE = 2;
    
    protected static $_collectionName = 'content_type';
    
    private static function _getDefaultData() {
        return array(
            'name' => '',
            'flags' => 0,
            'fields' => array()
        );
    }
    
    protected static function _getDb() {
        return Application::getStructureDb();
    }
    
    public static function create($name) {
        if (static::_getCollection()->findOne(array('name' => $name))) {
            throw new Content_Type_Exception('Duplicate content type "'.$name.'"', Content_Type_Exception::CODE_DUP_CONTENT_TYPE);
        }
        
        $data = static::_getDefaultData();
        $data['name'] = $name;
        
        return parent::create($data);
    }
    
    function addField($name, $flags = 0) {
        
        $db = Application::getStructureDb();
        
        // check if field is already set by querying on it. 
        // If we want to match multiple fields in the array we would 
        // have to use the $elemMatch operator.
//        $db->content_type->findOne(array(
//        	'name' => $this->_data['name'],
//        	'fields' => array('$elemMatch' => array('name' => $name)))
        if ($db->content_type->findOne(array(
        	'name' => $this->_data['name'],
        	'fields.name' => $name))
        ) {
            throw new Content_Type_Exception('Duplicate content type field "'.$name.'"', Content_Type_Exception::CODE_DUP_FIELD);    
        }
        
        $fields = (isset($this->_data['fields']) ? $this->_data['fields'] : array());
        $fields[] = array('name' => $name, 'flags' => $flags);
        
        $this->_data['fields'] = $fields;
        $this->_save();
        return $this;
    }
    
    function removeField($name) {
        $fields = (isset($this->_data['fields']) ? $this->_data['fields'] : array());
        foreach($fields as $key => $field) {
            if ($field['name'] == $name) {
                unset($fields[$key]);
            }
        }
        // Make sure we normalize the array! If we don't, Mongo might 
        // not see it as an array so some queries won't work.
        $fields = array_values($fields);
        $this->_data['fields'] = $fields;
        $this->_save();
        
        return $this;
    }
    
    public static function getByName($name) {
        $data = self::_getCollection()->findOne(array('name' => $name));
        if ($data) {
            return new self($data);
        } else {
            throw new Content_Type_Exception('Content type ' . $name . ' not found.', Content_Type_Exception::CODE_NOT_FOUND);
        }
        return;
    }
    
    public function getFields() {
        return $this->_data['fields'];
    }
    
    public function transformData($data) {
        $formattedData = array();
        foreach($this->_data['fields'] as $field) {
            if (($field['flags'] & Content_Type_Field::FIELD_REQUIRED) > 0) {
                if (!isset($data[$field['name']])) {
                    throw new Content_Type_Exception('Required field '.$field['name'].' not set in data', Content_Type_Exception::CODE_REQUIRED_FIELD);
                }
            }
            $formattedData[$field['name']] = $data[$field['name']];
        }
        return $formattedData;
    }
}