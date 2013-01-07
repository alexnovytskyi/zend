<?php

class Includes_Validator_Passwordconfirm extends Zend_Validate_Abstract {

    const NOT_MATCH = 'notMatch';

    protected $_messageTemplates = array(
        self::NOT_MATCH => "Пароли не совпадают!");

    public function isValid($value, $context = null) {
        $value = (string) $value;
        if (is_array($context)) {
            if (isset($context['password']) && ($value == $context['password'])) {
                return true;
            } else if (is_string($context && ($value == $context))) {
                return true;
            } else {
                $this->_error(self::NOT_MATCH);
                return false;
            }
        }
    }

}

?>
