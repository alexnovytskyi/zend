<?php

class Form_Registration extends Zend_Form {

    public function __construct() {
        $this->setName('form_registration');
        parent::__construct();

        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Имя пользователя')
                ->setRequired(true)
                ->addValidator('NotEmpty')
                ->addValidator('Alnum')
                ->addValidator("Db_NoRecordExists", false, array(
                    "table" => "users",
                    "field" => "username"
                ))
                ->addFilter('StringTrim')
                ->addFilter('StripTags');

        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Пароль')
                ->setRequired(true)
                ->addValidator('NotEmpty');

        $password_confirm = new Zend_Form_Element_Password('password_confirm');
        $password_confirm->setLabel('Повторите пароль')
                ->setRequired(true)
                ->addValidator('NotEmpty')
                ->addPrefixPath("Includes_Validator", "Includes/Validator","validate")
                ->addValidator('Passwordconfirm');

        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email')
                ->addValidator('EmailAddress');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Добавить');

        $this->addElements(array($username, $password,$password_confirm, $email, $submit));
    }

}

?>
