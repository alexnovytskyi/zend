<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Test
 *
 * @author alexandr
 */
class Form_Test extends Zend_Form {

    //put your code here
    public function __construct() {
        $this->setName('test');
        parent::__construct();

        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Имя пользователя')
                ->setRequired();

        $phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel('Ваш телефон')
                ->setRequired()
                ->addValidator('int')
                ->getValidator('int')->setMessage('Только числа!');
        $phone->addValidator('stringLength', false, array(6, 20))
                ->getValidator('stringLength')->setMessage('Только от 6до20 ска ns xt uecm ye gkuzl');

        $submit = new Zend_Form_Element_Submit('submit');


        $this->addElements(array($username, $phone, $submit));
    }

}

?>
