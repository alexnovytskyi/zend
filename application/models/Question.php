<?php

class Model_Question extends Includes_Model {

    public function __construct($id = null) {
        parent::__construct(new Model_DbTable_Questions, $id);
    }

    public function getAuthor() {
        return $this->_row->findParentRow(new Model_DbTable_Users, 'User');
    }

    public function getAnswers(){
        return $this->_row->findDependentRowSet(new Model_DbTable_Answers, 'Question');
    }
}

?>
