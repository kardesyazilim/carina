<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Http\Request;

use Zend\Session\Storage\ArrayStorage;
use Zend\Session\SessionManager;
use Zend\Http\Cookies;
use Zend\Session\Container;


class IndexController extends AbstractActionController {
	protected $_objectManager;
    protected $_websiteName;
    protected $_websiteId;

    public function indexAction() {

        //session and cookie blok

        $session = new Container('base');


        //session and cookie blok

       
       //var_dump($this->getUrl());
       //die();
       // echo 

           
        $url = $this->getEvent()->getRouteMatch()->getParam('url'); 
        $returnUrl = $this->getRequest()->getServer('HTTP_REFERER');
        if($url == '' || $url == 'kurumsal' || $url == 'bireysel' ){
            if($url == ''){
                $session->offsetSet('url', 'bireysel');
            }
            else{
                $session->offsetSet('url', $url);
                
            }
            //$activeUrl = $url;
        }
        $session->offsetSet('returnUrl', $returnUrl);
        $this->_websiteName = $session->offsetGet('url');
        if($this->_websiteName == 'kurumsal'){
            $quickLinks = $this->getNav(1,1,6,2);//kurumsal quick
            $mainNavs   = $this->getNav(1,1,3,2);//kurumsal main
            $footerNavs = $this->getNav(1,1,4,2);//kurumsal alt
        }
        else{
            $quickLinks = $this->getNav(1,1,5,1);//bireysel quick
            $mainNavs   = $this->getNav(1,1,1,1);//bireysel main
            $footerNavs = $this->getNav(1,1,2,1);//bireysel footer
        }
        if($url == '' ){
            $pageId =$this->getUrl($this->_websiteName);
        //echo $url;
        $centerBody = $this->getBody($pageId);
        
        }
        else{
            $pageId =$this->getUrl($url);
           // echo $url;
            $centerBody = $this->getBody($pageId);
            
        }
        //echo $centerBody[0]->getBody();
        //echo $pageId;
       
        //var_dump($centerBody);
        //die();
        //$this->_websiteId = $this->getWebsiteId();  
     
        //session kontrol

        //url göre içerik
        //yan menu varsa 
        
        //api get

        //post form


        //footer

        //return new ViewModel(array('websites' => $websites));



        //$this->getServiceLocator()->get('ViewHelperManager')->get('HeadTitle')->set('Dinamo Elektrik');

        //var_dump($this->getRequest()->getServer('HTTP_REFERER'));
        //die();

  


       
        //var_dump($this->getNav()[0]->getName());
        //die();


        $view = new ViewModel();

  
        $view->setTemplate( 'application/index/index' );
      
        //header area add config add spec css
        $headerView = new ViewModel(array( 'headers' => $this->getWebsite(), 'activeUrl' => $this->_websiteName ) );
        $headerView->setTemplate('index/header');

        //quick nav
        $quickView = new ViewModel(array('quicks' => $quickLinks ) );
        $quickView->setTemplate('index/quick');
        //main nav
        $navView = new ViewModel(array('navs'=>$mainNavs,'website' => $this->_websiteName ) );
        $navView->setTemplate('index/navigation');
        //center area 
        $centerView = new ViewModel( array( 'center' => $centerBody[0]->getBody() ) );
        $centerView->setTemplate('index/center');
        //footer area
        $footerView = new ViewModel(array('footers'=>$footerNavs));
        $footerView->setTemplate('index/footer');

        $view->addChild($headerView, 'header')
             ->addChild($quickView, 'quick')
             ->addChild($navView, 'navigation')
             ->addChild($centerView, 'center')
             ->addChild($footerView, 'footer');

        return $view;


        

    }
    protected function getWebsite(){
        return $this->getObjectManager()->getRepository('\Application\Entity\Website')->findBy(array('status'=>'1'));
    }
    protected function getNav($status,$parentId,$catId,$websiteId){
        //add param
      
        return $this->getObjectManager()->getRepository('\Application\Entity\Category')->findBy( array( 'status' => $status, 'parentId' => $parentId, 'catId' => $catId, 'websiteId' => $websiteId ) ) ;
    }
    protected function getWebsiteId(){
       return $this->getObjectManager()->getRepository('\Application\Entity\Website')->findBy(array('status'=>'1','name'=>$this->_websiteName));
    }
    protected function getUrl($key){
        $url = $this->getObjectManager()->getRepository('\Application\Entity\Url')->findOneBy(array('name' => $key));

        return $url->getId();
    }
    protected function getBody($urlId){
        $body =$this->getObjectManager()->getRepository('\Application\Entity\Content')->findBy(array('urlId'=>$urlId));
        return $body ;
    }
    protected function getObjectManager()
    {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }
    protected function campainAction(){

    }

}
