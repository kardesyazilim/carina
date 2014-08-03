<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\User;


class IndexController extends AbstractActionController {
	protected $_objectManager;
    public function indexAction() {
        





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


   

        $view = new ViewModel();

  
        $view->setTemplate( 'application/index/index' );
      
        //header area add config add spec css
        $headerView = new ViewModel(array( 'headers' => $this->getWebsite() ) );
        $headerView->setTemplate('index/header');

        //quick nav
        $quickView = new ViewModel(array('quicks' => 'quick'));
        $quickView->setTemplate('index/quick');
        //main nav
        $navView = new ViewModel(array('navs'=>'navs'));
        $navView->setTemplate('index/navigation');
        //center area 
        $centerView = new ViewModel(array('center' => 'center', ));
        $centerView->setTemplate('index/center');
        //footer area
        $footerView = new ViewModel(array('footer'=>'footer'));
        $footerView->setTemplate('index/footer');

        $view->addChild($headerView, 'header')
             ->addChild($quickView, 'quick')
             ->addChild($navView, 'navigation')
             ->addChild($centerView, 'center')
             ->addChild($footerView, 'footer');

        return $view;


        

    }
    protected function getWebsite(){
        return $websites = $this->getObjectManager()->getRepository('\Application\Entity\Website')->findBy(array('status'=>'1'));
    }
    protected function getNav(){
        //add param
        $navs = $this->getObjectManager()->getRepository('\Application\Entity\Category')->findBy(array('status'=>'1'));
    }
    protected function getObjectManager()
    {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }

}
