<?php

class Form_ResetPassword extends Zend_Form {

    public function __construct() {
        $this->setName('form_reset_password');
        parent::__construct();


        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email')
                ->addValidator('EmailAddress');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Отправить');

        $this->addElements(array($email, $submit));
    }

}

?>
