<?php

class Model_User extends Includes_Model {

    public function __construct($id = null) {
        parent::__construct(new Model_DbTable_Users, $id);
    }

    public function getAllUsers() {
        return $this->_dbTable->fetchAll();
    }

    public function authorize($username, $password) {
        $auth = Zend_Auth::getInstance();
        $authAdapter = new Zend_Auth_Adapter_DbTable(
                        Zend_Db_Table::getDefaultAdapter(),
                        'users',
                        'username',
                        'password',
                        'sha(?) AND activated = 1');
        $authAdapter->setIdentity($username)
                ->setCredential($password);

        $result = $auth->authenticate($authAdapter);
        if ($result->isValid()) {
            $storage = $auth->getStorage();
            $storage->write($authAdapter->getResultRowObject(null, array('password')));
            return true;
        }
        return false;
    }

    public function resetPassword($email, $password) {
        $user = $this->_dbTable->fetchRow($this->_dbTable->select()->where("email = '" . $email . "'"));
        $new_password = sha1($password);
        if ($user) {
            $data = array("password" => $new_password);
            $where = "email = '" . $email . "'";
            if ($rows_affected = $this->_dbTable->update($data, $where)) {
                $mail = new Includes_Mail();
                $mail->addTo($email);
                $mail->setSubject("Восстановление пароля");
                $mail->setBodyView('passwordReset', array("email" => $email, "password" => $password));
                $mail->send();
                return true;
            }
        } else {
            return false;
        }
    }

    public function populateForm() {
        return $this->_row->toArray();
    }

    public function sendActivationEmail() {
        $mail = new Includes_Mail();
        $mail->addTo($this->_row->email);
        $mail->setSubject("Активация аккаунта");
        $mail->setBodyView("activation", array("user" => $this));
        $mail->send();
    }

    public function sendSuccessfullActivationEmail() {
        $mail = new Includes_Mail();
        $mail->addTo($this->_row->email);
        $mail->setSubject("Успешная активация аккаунта");
        $mail->setBodyView("confirmation", array("user" => $this));
        $mail->send();
    }

}

?>
