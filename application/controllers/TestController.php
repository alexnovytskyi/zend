<?php

/**
 * Description of TestController
 *
 * @author alexandr
 */
class TestController extends Zend_Controller_Action {

    public function init() {
        
    }

    private function generateItems() {
        $items = array();
        for ($i = 0; $i < 5; $i++) {
            $newItem = new Includes_Ajax();
            $newItem->name = md5(uniqid());
            $newItem->desc = 'some desc';
            $newItem->id = $i;

            $items[] = $newItem;
        }
        return $items;
    }

    public function formAction() {
        $form = new Form_Test();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getPost())) {
                var_dump($form->getValues());
            }
        }
        $this->view->form = $form;
    }

    public function validateformAction() {
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->getHelper('layout')->disableLayout();
        $f = new Form_Test();
        $f->isValid($this->_getAllParams());
        $json = $f->getMessages();
        header('Content-type: application/json');
        echo Zend_Json::encode($json);
    }

    public function getAction() {
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->getHelper('layout')->disableLayout();

        echo Zend_Json_Encoder::encode($this->generateItems());
    }

    public function getitemAction() {
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->getHelper('layout')->disableLayout();

        $id = $this->getRequest()->getParam('id');
        $items = $this->generateItems();

        echo Zend_Json_Encoder::encode($items[$id]);
    }

    public function viewAction() {
        echo 'hello';
    }

    public function indexAction() {
        $this->view->headTitle('Тестовый контроллер', 'PREPEND');
        $this->view->autocompleteElement = new ZendX_JQuery_Form_Element_AutoComplete('city');
        $this->view->autocompleteElement->setLabel('AutoCompletezz');
        $this->view->autocompleteElement->setJQueryParam(
                'source', '/test/city');
        // action body
    }

    public function cityAction() {
        $results = Model_City::search($this->_getParam('term'));
        $this->_helper->json(array_values($results));
    }

}

?>
