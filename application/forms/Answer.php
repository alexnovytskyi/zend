<?php

class Form_Answer extends Zend_Form {

    public function __construct() {
        $this->setName('answer_form');
        parent::__construct();

        $description = new Zend_Form_Element_Textarea('answer');
        $description->setLabel('Введите свой ответ');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Добавить ответ');

        $this->addElements(array($description, $submit));
    }

}

?>
