<?php

class Plugin_Acl extends Zend_Controller_Plugin_Abstract {

    private $_location = array(
        'controller' => 'error',
        'action' => 'denied'
    );

    public function __construct() {
        $acl = new Zend_Acl();

        //roles
        $acl->addRole(new Zend_Acl_Role('guest'));
        $acl->addRole(new Zend_Acl_Role('user'), 'guest');
        $acl->addRole(new Zend_Acl_Role('admin'));

        //resources
        $acl->add(new Zend_Acl_Resource('users'));
        $acl->add(new Zend_Acl_Resource('index'));

        //permissions
        $acl->deny();
        $acl->allow('admin', NULL);
        //guest permissions
        $acl->allow('guest', 'users', array(
            'login', 'registration', 'confirm'
        ));
        $acl->allow('guest', 'index');
        //user permissions
        $acl->allow('user', 'users', array(
            'logout', 'confirm'
        ));
        $acl->deny('user','users',array(
            'login','registration'
        ));


        Zend_Registry::set('acl', $acl);
    }

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        $auth = Zend_Auth::getInstance();
        $acl = Zend_Registry::get('acl');

        if ($auth->hasIdentity()) {
            $role = $auth->getIdentity()->role;
        } else {
            $role = 'admin';
        }

        if (!$acl->hasRole($role)) {
            $role = 'admin';
        }

        $controller = $request->controller;
        $action = $request->action;

        if (!$acl->has($controller)) {
            $controller = null;
        }

        if (!$acl->isAllowed($role, $controller, $action)) {
            $request->setControllerName('error');
            $request->setActionName('denied');
        }
    }

}

?>