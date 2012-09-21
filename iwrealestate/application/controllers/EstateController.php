<?php

class EstateController extends Zend_Controller_Action
{
    public function init()
    {
        
    }
    
    public function estatedetailAction()
    {
        
        //----- start for model ------//
        
        $model_estate= new Model_Estate;
        
        //----- end for model ------//
        
       $estate_id=$this->getRequest ()->getParam ( 'id' );
              
       $total_number=$model_estate->check_estate_details($estate_id);
      
       
       if($total_number=='0')
       {
           $this->_redirect(ROOT_PATH);
       }
       
       $estate_detail_arr=$model_estate->estate_details($estate_id);
       
       $this->view->estate_title=$estate_title=$estate_detail_arr['EstateTitle'];
       $this->view->estate_description=$estate_description=$estate_detail_arr['EstateDetail'];
       $this->view->estate_price=$estate_price=$estate_detail_arr['Price'];
       $this->view->estate_country=$estate_price=$estate_detail_arr['CountryName'];
       $this->view->estate_city=$estate_price=$estate_detail_arr['City'];
       $this->view->estate_tot_room=$estate_tot_room=$estate_detail_arr['TotalRoom'];
       $this->view->estate_tot_bath_room=$estate_tot_bath_room=$estate_detail_arr['TotalBathroom'];
       $this->view->estate_surface=$estate_surface=$estate_detail_arr['Surface'];
       $this->view->estate_other_utility=$estate_other_utility=$estate_detail_arr['OtherUtility'];
       $this->view->estate_image=$estate_image=$estate_detail_arr['ImageName'];
              
    }
    
    public function postsearchAction()
    {
        $this->_helper->layout->disableLayout();
        
       $this->_helper->viewRenderer->setNoRender(true);
        
        if($this->_request->getPost('submit')!=NULL)
        {
            
            //-------- start for parameter for search ---------//
        
            $city=$this->_request->getPost ( 'city' );
            $price=$this->_request->getPost ( 'price' );
            $price_to=$this->_request->getPost( 'price_to' );
            $rooms=$this->_request->getPost( 'rooms' );
            $trans_type=$this->_request->getPost( 'trans_type' );
        
       //-------- end for parameter for search ---------//
            
            switch($trans_type)
            {
                case '1':
                $trans_type_val='sell' ;
                    break;

                case '2':
                $trans_type_val='rent' ;
                    break;

                default:
                $trans_type_val='all' ;
                    break; 
            }
            
          
            
            $this->_redirect(ROOT_PATH.'estate-list/'.$trans_type_val."?city=$city&price=$price&price_to=$price_to&rooms=$rooms&search=y");
        }
        else {
                $this->_redirect(ROOT_PATH);
        }
        
        
    }
    
    
    public function estatelistAction()
    {
        //----- start for model ------//
        
        $model_estate= new Model_Estatesearch;
        
        //----- end for model ------//
        
        $trans_type=$this->getRequest ()->getParam ( 'transtype' );
        
        //-------- start for parameter for search ---------//
        
            $city=$this->getRequest ()->getParam ( 'city' );
            $price=$this->getRequest ()->getParam ( 'price' );
            $price_to=$this->getRequest ()->getParam ( 'price_to' );
            $rooms=$this->getRequest ()->getParam ( 'rooms' );
            $search_status=$this->getRequest ()->getParam ( 'search' );
        
       //-------- end for parameter for search ---------//
        
        switch($trans_type)
        {
            case 'sell':
               $trans_type_id='1' ;
               $search_heading="Selleng Homes";               
                break;
            
            case 'rent':
               $trans_type_id='2' ;
               $search_heading="Renting Homes";
                break;
            
            default:
               $trans_type_id='' ;
               $search_heading="Selling & Renting Homes";
                break; 
        }
        
        //--------- assign the values to left panel & others ------------//
        
            $this->view->search_heading=$search_heading;
            
            if($search_status=='y')
            {
                $this->view->trans_type_id=$trans_type_id;
                $this->view->city=$city;
                $this->view->price=$price;
                $this->view->price_to=$price_to;
                $this->view->rooms=$rooms;
            }
            
       //--------- assign the values to left panel & others ------------//
      
      $estate_array=$model_estate->estate_list($trans_type_id,$city,$price,$price_to,$rooms);
      
        $paginator = Zend_Paginator::factory($estate_array);
        $paginator->setCurrentPageNumber($this->_getParam('page',1));
        $paginator->setItemCountPerPage(10);
           
       
       $this->view->paginator = $paginator;
    }
    
    
    
}

?>