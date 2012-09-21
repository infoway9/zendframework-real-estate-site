<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
     

    protected function _initAutoload()
    {
        
        
        $moduleLoader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '', 
            'basePath'  => APPLICATION_PATH));
        return $moduleLoader;
        
       
    }
    
    protected function _initDoctype()
    {
          
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
        $view->setEncoding('UTF-8');
             
    }
    
        
    protected function _initheadlinks()
    {
       
        
        $this->view->headLink()->appendStylesheet(ROOT_PATH.'css/style.css');
        $this->view->headScript()->appendFile(ROOT_PATH.'js/jquery.js');
        $this->view->headTitle('Build Up Real Estate ');
        $this->view->headLink(array('rel' => 'icon',
                                  'href' => ROOT_PATH.'favicon.ico'),
                                  'PREPEND');
    }
    
    protected function _initRouter()
    {
        $r = Zend_Controller_Front::getInstance();

        $router = $r->getRouter();
       
        
        //-------- start for front end -------//
        
         $router->addRoute(
    'details',
    new Zend_Controller_Router_Route('details/:id',
                                     array('controller' => 'estate',
                                           'action' => 'estatedetail'))
        );
         
         $router->addRoute(
    'estate-list',
    new Zend_Controller_Router_Route('estate-list/:transtype/:page',
                                     array('controller' => 'estate',
                                           'action' => 'estatelist','transtype'=>'all','page'=>''))
        );
         
         
         $router->addRoute(
    'post-search',
    new Zend_Controller_Router_Route('post-search',
                                     array('controller' => 'estate',
                                           'action' => 'postsearch'))
        );
        
        //-------- end for front end -------//
        
        
        //-------- start for admin end -------//
        
         $router->addRoute(
    'admin/view-estate',
    new Zend_Controller_Router_Route('admin/view-estate/:page',
                                     array('controller' => 'adminestate',
                                           'action' => 'viewestate','page'=>''))
        );
         
        $router->addRoute(
    'admin/add-estate',
    new Zend_Controller_Router_Route('admin/add-estate',
                                     array('controller' => 'adminestate',
                                           'action' => 'addestate'))
        );
        
        $router->addRoute(
    'admin/edit-estate',
    new Zend_Controller_Router_Route('admin/edit-estate/:estateid',
                                     array('controller' => 'adminestate',
                                           'action' => 'editestate'))
        );
        
        $router->addRoute(
    'admin/delete-estate',
    new Zend_Controller_Router_Route('admin/delete-estate/:estateid',
                                     array('controller' => 'adminestate',
                                           'action' => 'deleteestate'))
        );
        
        //-------- end for admin end -------//
    }
    
}

