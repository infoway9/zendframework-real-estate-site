<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        
            }

    public function indexAction()
    {
        // action body
        
        //----- start for model ------//
        
        $model_estate= new Model_Estate;
        
        //----- end for model ------//
        
        //------- start for display normal estate ---------//
        
        $normal_estate_detail=$model_estate->display_normal_estate();
                
        $this->view->normal_estate_detail=$normal_estate_detail;
        
        //------- end for display normal estate ---------//
        
        
        //------- start for display special estate ---------//
        
        $special_estate_detail=$model_estate->display_special_estate();
        
                       
        $this->view->special_estate_detail_estate_detail=$special_estate_detail;
        
        //------- end for display special estate ---------//
        
    }


}

