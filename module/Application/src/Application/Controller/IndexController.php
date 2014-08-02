<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\User;


class IndexController extends AbstractActionController {
	 protected $_objectManager;
    public function indexAction() {
        $websites = $this->getObjectManager()->getRepository('\Application\Entity\Website')->findBy(array('status'=>'1'));

         return new ViewModel(array('websites' => $websites));



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
