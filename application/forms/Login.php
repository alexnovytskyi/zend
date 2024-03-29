<?php

class Form_Login extends Zend_Form {

    public function __construct() {
        $this->setName('form_login');
        parent::__construct();

        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Имя пользователя');

        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Пароль');


        $submit = new Zend_Form_Element_Submit('login');
        $submit->setLabel("Войти");
        
        $this->addElements(array($username,$password,$submit));
    }

}

?>
