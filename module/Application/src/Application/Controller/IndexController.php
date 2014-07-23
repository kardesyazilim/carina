<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    public function indexAction() {
        
        $this->getServiceLocator()->get('ViewHelperManager')->get('HeadTitle')->set('Dinamo Elektrik');
        //$profiler = $this->get('Zend\Db\Adapter\Adapter')->getProfiler();
        //$queryProfiles = $profiler->getQueryProfiles();
        //$this->getServiceLocator()->get('ViewHelperManager')->get('HeadTitle')->set('Dinamo Elektrik');
    }

}
