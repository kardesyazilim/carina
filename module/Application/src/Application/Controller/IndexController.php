<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\User;


class IndexController extends AbstractActionController {
	 protected $_objectManager;
    public function indexAction() {
        $websites = $this->getObjectManager()->getRepository('\Application\Entity\Website')->findBy(array('status'=>'1'));





        $url = $this->getEvent()->getRouteMatch()->getParam('url'); 

        //bireysel kurumsal ayracı
        //session kontrol

        //url göre içerik
        //yan menu varsa 
        
        //api get
        
        //post form


        //footer

        //return new ViewModel(array('websites' => $websites));



        //$this->getServiceLocator()->get('ViewHelperManager')->get('HeadTitle')->set('Dinamo Elektrik');


        //return new ViewModel(array('users' => $users));

        $view = new ViewModel();

        // this is not needed since it matches "module/controller/action"
        $view->setTemplate('application/index/index');
      

        $headerView = new ViewModel(array('headers'=>$websites));
        $headerView->setTemplate('index/header');


        $quickView = new ViewModel(array('quick' => 'quick'));
        $quickView->setTemplate('index/quick');

        //$secondarySidebarView = new ViewModel();
        //$secondarySidebarView->setTemplate('content/secondary-sidebar');

        //$sidebarBlockView = new ViewModel();
        //$sidebarBlockView->setTemplate('content/block');

        //$secondarySidebarView->addChild($sidebarBlockView, 'block');

        $view->addChild($headerView, 'header')
             ->addChild($quickView, 'quick');
             //->addChild($secondarySidebarView, 'sidebar_secondary');

        return $view;


        

    }
  
    protected function getObjectManager()
    {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }

}
