<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initViewHelpers() {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $view->headMeta()->appendHttpEquiv('Content-type', 'text/html;charset=utf-8');
        $view->headTitle('Testing Zend');
        $view->headTitle()->setSeparator(' :: ');
        $view->addHelperPath(
                'ZendX/JQuery/View/Helper', 'ZendX_JQuery_View_Helper'
        );
        $view->jQuery()
                ->setVersion('1.7.2')
                ->setUiVersion('1.9.2')
                ->addStylesheet($view->baseUrl().'/css/dot-luv/jquery-ui.css');
        $view->jQuery()->enable();

        if (!Zend_Auth::getInstance()->hasIdentity()) {
            $view->identity = false;
        } else {
            $view->identity = Zend_Auth::getInstance()->getIdentity();
        }
    }

    protected function _initAutoload() {
        $moduleLoader = new Zend_Application_Module_Autoloader(array(
                    'namespace' => '',
                    'basePath' => APPLICATION_PATH));
        $autoLoader = Zend_Loader_Autoloader::getInstance();
        $autoLoader->registerNamespace(array("Includes_"));
    }

    protected function _initRegistry() {
        $resource = $this->getPluginResource('db');
        Zend_Registry::set('db', $resource->getDbAdapter());
    }

    protected function _initPlugins() {
        $front = Zend_Controller_Front::getInstance();
        $front->registerPlugin(new Plugin_Acl());
    }

    protected function _initEmail() {
        $email_config = array(
            "auth" => "login",
            "ssl" => "ssl",
            "username" => "alexandr.novitskiy",
            "password" => "ronya123",
            "port" => "465"
        );
        $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $email_config);
        Zend_Mail::setDefaultTransport($transport);
    }

}

