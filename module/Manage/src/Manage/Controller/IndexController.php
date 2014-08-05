<?php
namespace Manage\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Request;
use Zend\Session\Storage\ArrayStorage;
use Zend\Session\SessionManager;
use Zend\Http\Cookies;
use Zend\Session\Container;


class IndexController extends AbstractActionController 
{
	public function indexAction() {
		echo 'tes';
	}
}