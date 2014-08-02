<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\User;


class IndexController extends AbstractActionController {
	 protected $_objectManager;
    public function indexAction() {
        $websites = $this->getObjectManager()->getRepository('\Application\Entity\Website')->findBy(array('status'=>'1'));

        //return new ViewModel(array('websites' => $websites));



        //$this->getServiceLocator()->get('ViewHelperManager')->get('HeadTitle')->set('Dinamo Elektrik');


        //return new ViewModel(array('users' => $users));

         $view = new ViewModel();

        // this is not needed since it matches "module/controller/action"
        $view->setTemplate('application/index/quick');

        $quickView = new ViewModel(array('quick' => 'quick'));
        $quickView->setTemplate('index/quick');

        //$primarySidebarView = new ViewModel();
        //$primarySidebarView->setTemplate('content/main-sidebar');

        //$secondarySidebarView = new ViewModel();
        //$secondarySidebarView->setTemplate('content/secondary-sidebar');

        //$sidebarBlockView = new ViewModel();
        //$sidebarBlockView->setTemplate('content/block');

        //$secondarySidebarView->addChild($sidebarBlockView, 'block');

        //$view->addChild($quickView, 'quick');
             //->addChild($primarySidebarView, 'sidebar_primary')
             //->addChild($secondarySidebarView, 'sidebar_secondary');

        return $view;


        

    }
    protected function quickAction(){

    }
    protected function getObjectManager()
    {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }

}
