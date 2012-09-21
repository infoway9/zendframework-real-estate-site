<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        
        $admin = new Model_Admina;
         
        $this->_helper->layout->disableLayout();
    }
    
        
    
    public function indexAction()
    {
                 
                     //--------- start for authentication ------------//
        
        $registry   = Zend_Registry::getInstance();
        $auth = Zend_Auth::getInstance();
        
        if($auth->hasIdentity())
        {
             
            $this->_redirect('admin/view-estate');
                           
                  
        }
        
         //--------- end for authentication ------------//


        
        if($this->_request->getPost('submit_btn')!=NULL)
        {
            
            $error_msg="";
           
            
            $textusername=$this->_request->getPost('textusername');
            $textpassword=$this->_request->getPost('textpassword');
            
            
                       
            
            if($textusername=="")
            {
                $error_msg="Please enter the user name";
            }
            else if($textpassword=="")
            {
                $error_msg="Please enter the password";
            }
            
            
            
           if($error_msg=="")
                {
                        $db = $registry['DB'];        
        
                        $authAdapter = new Zend_Auth_Adapter_DbTable($db);

                        $authAdapter->setTableName('admin')
                                    ->setIdentityColumn('UserName')
                                    ->setCredentialColumn('Password');


                    $authAdapter->setIdentity($textusername);
                    $authAdapter->setCredential(md5($textpassword));
                    $select = $authAdapter->getDbSelect();
                    $select->where('Status = "1"');


                    $result = $authAdapter->authenticate();

                        if($result->isValid())
                        {
                         
                            $data = $authAdapter->getResultRowObject(null,
                        'password');
                        $auth->getStorage()->write($data);
                                                        
                        $this->_redirect('admin/view-estate');
                        
                        }
                        else {
                            
                            $error_msg="Wrong username and password combination.";

                        }
                        
                }
                
                //------- start for display the error msg ---------//
                
                if($error_msg!="")
                {
                    $formData = $this->getRequest()->getPost();


                    foreach($formData as $k=>$v)
                    {
                        $this->view->$k=$v;
                    }

                    $this->view->error_msg=$error_msg;
                }

              //---------- end for display the error msg ------------//
        }
        
    }
    
    
    
    
    public function logoutAction()
    {
         //--------- start for authentication ------------//
        
            $auth = Zend_Auth::getInstance();

            if($auth->hasIdentity())
            {
                $auth->clearIdentity();

            }
        
        //--------- end for authentication ------------//
            
        $this->_helper->viewRenderer->setNoRender(true);
        
        $this->_redirect('admin');
    }
    
        


}


?>