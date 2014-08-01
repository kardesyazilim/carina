<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\User;


class IndexController extends AbstractActionController {
	 protected $_objectManager;
    public function indexAction() {
         // $users = $this->getObjectManager()->getRepository('\Application\Entity\User')->findAll();

          //var_dump($users);
          //die();
        //return new ViewModel(array('users' => $users));



        //$this->getServiceLocator()->get('ViewHelperManager')->get('HeadTitle')->set('Dinamo Elektrik');


        //return new ViewModel(array('users' => $users));
        
    }
    protected function getObjectManager()
    {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }

}
