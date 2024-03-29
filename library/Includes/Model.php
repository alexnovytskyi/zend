<?php

class Includes_Model {

    protected $_dbTable;
    protected $_row;

    public function __construct(Zend_Db_Table_Abstract $dbTable, $id) {
        $this->_dbTable = $dbTable;
        if ($id) {
            $this->_row = $this->_dbTable->find($id)->current();
        } else {
            $this->_row = $this->_dbTable->createRow();
        }
    }

    /*
     * Getters and Setters
     * of Users Model class
     */

    public function __set($name, $val) {
        if (isset($this->_row->$name)) {
            $this->_row->$name = $val;
        }
    }

    public function __get($name) {
        if (isset($this->_row->$name)) {
            return $this->_row->$name;
        }
    }

    public function fill($data) {
        foreach ($data as $key => $value) {
            if (isset($this->_row->$key)) {
                $this->_row->$key = $value;
            }
        }
    }

    public function delete() {
        $this->_row->delete();
    }

    public function getInfo() {
        
    }

    public function save() {
        $this->_row->save();
    }

}

?>
