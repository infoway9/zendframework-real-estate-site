<?php

class AdminestateController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        
                 
        $this->_helper->layout->disableLayout();
    }
    
        
    
    public function viewestateAction()
    {
        //--------- start for authentication ------------//
            
             $auth = Zend_Auth::getInstance();
       
                if(!$auth->hasIdentity())
                {
                        $this->_redirect('admin');
                }
                
        //--------- end for authentication ------------//
                
        //--------- start for meta title ---------//
                
            $this->view->meta_title='Estate list';
            
        //-------- end for meta title ---------//
        
                
        //----- start for admin layout -----//
        
            $this->_helper->layout->setLayout('admin_layout');
        
        //----- end for admin layout -----//
         
        //----- start for model ------//
            
                $admin_estate = new Model_Adminestate;
            
        //----- end for model -------//
                
                
        //----- start for get the real estate list ------//
               
            if($this->_request->getPost('page')!=NULL)
            {
                $page=$this->_request->getPost('page');
            }
            else if($this->_getParam('page')!=NULL)
            {
                $page=$this->_getParam('page');
            }
            else {
                $page=1;
            }
            
            
            
            $real_estate_list_array=$admin_estate->get_realestate();
            
            $paginator = Zend_Paginator::factory($real_estate_list_array);
            $paginator->setCurrentPageNumber($page);
            $paginator->setItemCountPerPage(10);
            
             $this->view->paginator = $paginator;
             
            
        //----- end for get the real estate list ------//
            
            
            
    }
    
    public function addestateAction()
    {
        //--------- start for authentication ------------//
            
             $auth = Zend_Auth::getInstance();
       
                if(!$auth->hasIdentity())
                {
                        $this->_redirect('admin');
                }
                
        //--------- end for authentication ------------//
        
         //--------- start for meta title ---------//
                
            $this->view->meta_title='Add estate';
            
        //-------- end for meta title ---------//
        
        include "resizeimage.php";
        
        $session = new Zend_Session_Namespace('addestate');
        
        $this->view->radiostatus="1";
        
        //----- start for admin layout -----//
        
            $this->_helper->layout->setLayout('admin_layout');
        
        //----- end for admin layout -----//
            
        //----- start for model ------//
            
            $others = new Model_Others;
            $admin_estate = new Model_Adminestate;
            
        //----- end for model -------//
            
        //----- start for get the country list ------//
            
            $country_list_array=$others->get_country();
                                   
            $this->view->country_list_array=$country_list_array;
            
        //----- end for get the country list ------//
            
        //------ start for initialize transaction type -------//    
            
            $this->view->transaction_list_array=array('1'=>'Sell','2'=>'Rent');
            
        //------ end for initialize transaction type -------//
            
        //------ start for display the success message -------//

        if(isset($session->success_msg))
            {
                    $this->view->success_msg=$session->success_msg;
                    
            }

        //------ end for display the success message -------//
        
        if($this->_request->getPost('submit_btn')!=NULL)
        {
            $error_msg="";
            
            //------ start for zend filter -------//
            
            $filterChain = new Zend_Filter();
            $filterChain->addFilter(new Zend_Filter_StringTrim())
                        ->addFilter(new Zend_Filter_StripTags());
            
            //------ end for zend filter --------//
            
            //------ start for zend validation ------//
            
            $valid_empty = new Zend_Validate_NotEmpty();
            $valid_int = new Zend_Validate_Int();
            $valid_float = new Zend_Validate_Float();
            
            //------ end for zend validation -------//
            
            //------ start for adapter for image upload --------//
            
            $adapter = new Zend_File_Transfer_Adapter_Http();
            $adapter->addValidator('Extension',false, array('gif','jpg','jpeg','png'));
                   
            //------ end for adapter for image upload --------//
            
            $texttitle=$filterChain->filter($this->_request->getPost('texttitle'));
            $textdescription=$filterChain->filter($this->_request->getPost('textdescription'));
            $selecttransaction=$filterChain->filter($this->_request->getPost('selecttransaction'));
            $textprice=$filterChain->filter($this->_request->getPost('textprice'));
            $selectcountry=$filterChain->filter($this->_request->getPost('selectcountry'));
            $textcity=$filterChain->filter($this->_request->getPost('textcity'));
            $texttotroom=$filterChain->filter($this->_request->getPost('texttotroom'));
            $texttotbathroom=$filterChain->filter($this->_request->getPost('texttotbathroom'));
            $textsurface=$filterChain->filter($this->_request->getPost('textsurface'));
            $textutility=$filterChain->filter($this->_request->getPost('textutility'));
            $specialtatus=$this->_request->getPost('specialtatus');
            if($specialtatus=="")
            {
                $specialtatus='0';
            }
            
            $radiostatus=$this->_request->getPost('radiostatus');
            
            
            
            $text_fileds=array('texttitle'=>$texttitle, 'textdescription'=>$textdescription,'selecttransaction'=>$selecttransaction,'textprice'=>$textprice, 'selectcountry'=>$selectcountry, 'textcity'=>$textcity, 'texttotroom'=>$texttotroom,
                                'texttotbathroom'=>$texttotbathroom, 'textsurface'=>$textsurface, 'textutility'=>$textutility, 'specialtatus'=>$specialtatus, 'radiostatus'=>$radiostatus
                               );
            
           
            
            if(!$valid_empty->isValid($texttitle))
            {
                $error_msg="Please enter title.";
            }
            else if(!$valid_empty->isValid($textdescription))
            {
                $error_msg="Please enter description.";
            }
            else if(!$valid_empty->isValid($selecttransaction))
            {
                $error_msg="Please select transaction.";
                
            }
            else if(!$valid_empty->isValid($textprice))
            {
                $error_msg="Please enter price.";
            }
            else if(!$valid_int->isValid($textprice) && !$valid_float->isValid($textprice))
            {
                $error_msg="Price should be integer or decimal.";
            }
            else if(!$valid_empty->isValid($selectcountry))
            {
                $error_msg="Please select country.";
            }
            else if(!$valid_empty->isValid($textcity))
            {
                $error_msg="Please enter city.";
            }
            else if(!$valid_empty->isValid($texttotroom))
            {
                $error_msg="Please enter total room.";
            }
            else if(!$valid_int->isValid($texttotroom))
            {
                $error_msg="Total room should be integer.";
            }
            else if(!$valid_empty->isValid($texttotbathroom))
            {
                $error_msg="Please enter total bathroom.";
            }
             else if(!$valid_int->isValid($texttotbathroom))
            {
                $error_msg="Total bathroom should be integer.";
            }
            else if(!$valid_empty->isValid($textsurface))
            {
                $error_msg="Please enter surface.";
            }
            else if(!$valid_empty->isValid($textsurface))
            {
                $error_msg="Please enter surface.";
            }
                      
            else if($adapter->isUploaded() && !$adapter->isValid())
            {
                $error_msg="Please upload valid image.";
            }
			
			
           
            
            if($error_msg!="")
                {
                   
                    foreach($text_fileds as $k=>$v)
                    {
                        $this->view->$k=$v;
                    }

                    $this->view->error_msg=$error_msg;
                }
                
           else{
                
               //-------- start for file transfer ---------//
               
                $product_id=Rand_String(6);
                
                if($adapter->isUploaded())
                {
                       
                   
                   $file_info=$adapter->getFileInfo();
                   $file_name=$file_info['gallery_upload']['name'];
                     
                   $file_extension=get_extension($file_name);
                   
                   $modified_file_name=$product_id.'.'.$file_extension;
                                    
                    
                   $target_file= ABSOLUTE_PATH.'/file_upload/estate_picture/temp/' .$modified_file_name; // original image
                   
                    $adapter->addFilter('Rename', array('target' => $target_file,'overwrite' => true)); #
                    
                    
                    if (!$adapter->receive()) {
                        $messages = $adapter->getMessages();
                        echo implode("\n", $messages);
                    }
                    else {
                                                    
                             //------- start for thumb image -------//

                            $image_resize = new Resize_Image;
                            $image_resize->new_width = 130;
                            $image_resize->new_height = 130;
                            $image_resize->image_to_resize=$target_file;
                            $image_resize->ratio = true; // Keep Aspect Ratio?
                            $image_resize->dynamic_ratio = true; // Keep Aspect Ratio?

			// Name of the new image (optional) - If it's not set a new will be added automatically

                            $image_resize->new_image_name = $product_id;

			/* Path where the new image should be saved. If it's not set the script will output the image without saving it */

                            $image_resize->save_folder = ABSOLUTE_PATH.'/file_upload/estate_picture/thumb/';
                            $thumb_process1 = $image_resize->resize();

                             //------- end for thumb image -------//
                            
                            
                             //------- start for preview image -------//

                            $image_resize = new Resize_Image;
                            $image_resize->new_width = 282;
                            $image_resize->new_height = 282;
                            $image_resize->image_to_resize=$target_file;
                            $image_resize->ratio = true; // Keep Aspect Ratio?
                            $image_resize->dynamic_ratio = true; // Keep Aspect Ratio?

			// Name of the new image (optional) - If it's not set a new will be added automatically

                            $image_resize->new_image_name = $product_id;

			/* Path where the new image should be saved. If it's not set the script will output the image without saving it */

                            $image_resize->save_folder = ABSOLUTE_PATH.'/file_upload/estate_picture/prev/';
                            $thumb_process1 = $image_resize->resize();

                             //------- end for preview image -------//
                            
                            unlink($target_file);
                    }
                    
                }
                else {
                        
                    $modified_file_name="";
                }
                            
    
               //-------- end for file transfer ----------//
                
                
              //-------- start for add data in database ---------//
                
                $data=array(
                    'Id'=>$product_id,
                    'EstateTitle'=>$texttitle,
                    'EstateDetail'=>$textdescription,
                    'TransactionType'=>$selecttransaction,
                    'Price'=>$textprice,
                    'CountryId'=>$selectcountry,
                    'City'=>$textcity,
                    'TotalRoom'=>$texttotroom,
                    'TotalBathroom'=>$texttotbathroom,
                    'Surface'=>$textsurface,
                    'OtherUtility'=>$textutility,
                    'ImageName'=>$modified_file_name,
                    'AddedDate'=>date("Y-m-d H:i:s"),
                    'SpecialStatus'=>$specialtatus,
                    'Status'=>$radiostatus
                  );
                
                
                
                $admin_estate->add_realestate($data);
                
                $session->success_msg="Data added successfully";
                $this->_redirect('admin/add-estate');
                        
             //-------- end for add data in database ---------//
           }
                
            
        }
        
        Zend_Session::namespaceUnset('addestate'); // unset namespace
    }
    
    
    public function editestateAction()
    {
        //--------- start for authentication ------------//
            
             $auth = Zend_Auth::getInstance();
       
                if(!$auth->hasIdentity())
                {
                        $this->_redirect('admin');
                }
                
        //--------- end for authentication ------------//
                
        //--------- start for meta title ---------//
                
            $this->view->meta_title='Edit estate';
            
        //-------- end for meta title ---------//
        
        include "resizeimage.php";
        
        $session = new Zend_Session_Namespace('addestate');
        
        $this->view->radiostatus="1";
        
        //----- start for admin layout -----//
        
            $this->_helper->layout->setLayout('admin_layout');
        
        //----- end for admin layout -----//
            
        //----- start for model ------//
            
            $others = new Model_Others;
            $admin_estate = new Model_Adminestate;
            
        //----- end for model -------//
            
        //----- start for fetch data from database ----//
            
            $estate_id=$this->getRequest ()->getParam ( 'estateid' );
            
            $total_estate=$admin_estate->checkget_specific_realestate($estate_id);
            
            if($total_estate==0)
            {
                $this->_redirect(ROOT_PATH.'admin');
            }
            
            $estate_array=$admin_estate->get_specific_realestate($estate_id);
            
            $f_texttitle=$estate_array['EstateTitle'];
            $f_textdescription=$estate_array['EstateDetail'];
            $f_selecttransaction=$estate_array['TransactionType'];
            $f_textprice=$estate_array['Price'];
            $f_selectcountry=$estate_array['CountryId'];
            $f_textcity=$estate_array['City'];
            $f_texttotroom=$estate_array['TotalRoom'];
            $f_texttotbathroom=$estate_array['TotalBathroom'];
            $f_textsurface=$estate_array['Surface'];
            $f_textutility=$estate_array['OtherUtility'];
            $f_textimage=$estate_array['ImageName'];
            $f_specialtatus=$estate_array['SpecialStatus'];
            $f_radiostatus=$estate_array['Status'];
            
            
       //----- end for fetch data from database ----//
            
        //----- start for get the country list ------//
            
            $country_list_array=$others->get_country();
                                   
            $this->view->country_list_array=$country_list_array;
            
        //----- end for get the country list ------//
            
        //------ start for initialize transaction type -------//    
            
            $this->view->transaction_list_array=array('1'=>'Sell','2'=>'Rent');
            
                       
        //------ end for initialize transaction type -------//
            
             $f_text_fileds=array('texttitle'=>$f_texttitle, 'textdescription'=>$f_textdescription,'selecttransaction'=>$f_selecttransaction,'textprice'=>$f_textprice, 'selectcountry'=>$f_selectcountry, 'textcity'=>$f_textcity, 'texttotroom'=>$f_texttotroom,
                                'texttotbathroom'=>$f_texttotbathroom, 'textsurface'=>$f_textsurface, 'textutility'=>$f_textutility, 'specialtatus'=>$f_specialtatus, 'radiostatus'=>$f_radiostatus
                               );
             
        //------ start for display the success message -------//

        if(isset($session->success_msg))
            {
                    $this->view->success_msg=$session->success_msg;
                    
            }

        //------ end for display the success message -------//
        
        if($this->_request->getPost('submit_btn')!=NULL)
        {
            $error_msg="";
            
            //------ start for zend filter -------//
            
            $filterChain = new Zend_Filter();
            $filterChain->addFilter(new Zend_Filter_StringTrim())
                        ->addFilter(new Zend_Filter_StripTags());
            
            //------ end for zend filter --------//
            
            //------ start for zend validation ------//
            
            $valid_empty = new Zend_Validate_NotEmpty();
            $valid_int = new Zend_Validate_Int();
            $valid_float = new Zend_Validate_Float();
            
            //------ end for zend validation -------//
            
            //------ start for adapter for image upload --------//
            
            $adapter = new Zend_File_Transfer_Adapter_Http();
            $adapter->addValidator('Extension',false, array('gif','jpg','jpeg','png'));
                   
            //------ end for adapter for image upload --------//
            
            $texttitle=$filterChain->filter($this->_request->getPost('texttitle'));
            $textdescription=$filterChain->filter($this->_request->getPost('textdescription'));
            $selecttransaction=$filterChain->filter($this->_request->getPost('selecttransaction'));
            $textprice=$filterChain->filter($this->_request->getPost('textprice'));
            $selectcountry=$filterChain->filter($this->_request->getPost('selectcountry'));
            $textcity=$filterChain->filter($this->_request->getPost('textcity'));
            $texttotroom=$filterChain->filter($this->_request->getPost('texttotroom'));
            $texttotbathroom=$filterChain->filter($this->_request->getPost('texttotbathroom'));
            $textsurface=$filterChain->filter($this->_request->getPost('textsurface'));
            $textutility=$filterChain->filter($this->_request->getPost('textutility'));
            $specialtatus=$this->_request->getPost('specialtatus');
            if($specialtatus=="")
            {
                $specialtatus='0';
            }
            
            $radiostatus=$this->_request->getPost('radiostatus');
            
            
            
            $text_fileds=array('texttitle'=>$texttitle, 'textdescription'=>$textdescription,'selecttransaction'=>$selecttransaction,'textprice'=>$textprice, 'selectcountry'=>$selectcountry, 'textcity'=>$textcity, 'texttotroom'=>$texttotroom,
                                'texttotbathroom'=>$texttotbathroom, 'textsurface'=>$textsurface, 'textutility'=>$textutility, 'specialtatus'=>$specialtatus, 'radiostatus'=>$radiostatus
                               );
            
           
            
            if(!$valid_empty->isValid($texttitle))
            {
                $error_msg="Please enter title.";
            }
            else if(!$valid_empty->isValid($textdescription))
            {
                $error_msg="Please enter description.";
            }
            else if(!$valid_empty->isValid($selecttransaction))
            {
                $error_msg="Please select transaction.";
                
            }
            else if(!$valid_empty->isValid($textprice))
            {
                $error_msg="Please enter price.";
            }
            else if(!$valid_int->isValid($textprice) && !$valid_float->isValid($textprice))
            {
                $error_msg="Price should be integer or decimal.";
            }
            else if(!$valid_empty->isValid($selectcountry))
            {
                $error_msg="Please select country.";
            }
            else if(!$valid_empty->isValid($textcity))
            {
                $error_msg="Please enter city.";
            }
            else if(!$valid_empty->isValid($texttotroom))
            {
                $error_msg="Please enter total room.";
            }
            else if(!$valid_int->isValid($texttotroom))
            {
                $error_msg="Total room should be integer.";
            }
            else if(!$valid_empty->isValid($texttotbathroom))
            {
                $error_msg="Please enter total bathroom.";
            }
             else if(!$valid_int->isValid($texttotbathroom))
            {
                $error_msg="Total bathroom should be integer.";
            }
            else if(!$valid_empty->isValid($textsurface))
            {
                $error_msg="Please enter surface.";
            }
            else if(!$valid_empty->isValid($textsurface))
            {
                $error_msg="Please enter surface.";
            }
                      
            else if($adapter->isUploaded() && !$adapter->isValid())
            {
                $error_msg="Please upload valid image.";
            }
			
			
           
            
            if($error_msg!="")
                {
                   
                    foreach($text_fileds as $k=>$v)
                    {
                        $this->view->$k=$v;
                    }

                    $this->view->error_msg=$error_msg;
                }
                
           else{
                
               //-------- start for file transfer ---------//
               
                $new_image_prefix=$estate_id.'-'.Rand_String(6);
                
                if($adapter->isUploaded())
                {
                    
                    if($f_textimage!="")
                    {
                        if(file_exists(ABSOLUTE_PATH.'/file_upload/estate_picture/thumb/' .$f_textimage))
                        {
                            unlink(ABSOLUTE_PATH.'/file_upload/estate_picture/thumb/' .$f_textimage);
                        }
                         
                        if(file_exists(ABSOLUTE_PATH.'/file_upload/estate_picture/prev/' .$f_textimage))
                        {
                            unlink(ABSOLUTE_PATH.'/file_upload/estate_picture/prev/' .$f_textimage);
                        }
                        
                    }
                       
                   
                   $file_info=$adapter->getFileInfo();
                   $file_name=$file_info['gallery_upload']['name'];
                     
                   $file_extension=get_extension($file_name);
                   
                   $modified_file_name=$new_image_prefix.'.'.$file_extension;
                                    
                    
                   $target_file= ABSOLUTE_PATH.'/file_upload/estate_picture/temp/' .$modified_file_name; // original image
                   
                    $adapter->addFilter('Rename', array('target' => $target_file,'overwrite' => true)); #
                    
                    
                    if (!$adapter->receive()) {
                        $messages = $adapter->getMessages();
                        echo implode("\n", $messages);
                    }
                    else {
                                                    
                             //------- start for thumb image -------//

                            $image_resize = new Resize_Image;
                            $image_resize->new_width = 130;
                            $image_resize->new_height = 130;
                            $image_resize->image_to_resize=$target_file;
                            $image_resize->ratio = true; // Keep Aspect Ratio?
                            $image_resize->dynamic_ratio = true; // Keep Aspect Ratio?

			// Name of the new image (optional) - If it's not set a new will be added automatically

                            $image_resize->new_image_name = $new_image_prefix;

			/* Path where the new image should be saved. If it's not set the script will output the image without saving it */

                            $image_resize->save_folder = ABSOLUTE_PATH.'/file_upload/estate_picture/thumb/';
                            $thumb_process1 = $image_resize->resize();

                             //------- end for thumb image -------//
                            
                            
                             //------- start for preview image -------//

                            $image_resize = new Resize_Image;
                            $image_resize->new_width = 282;
                            $image_resize->new_height = 282;
                            $image_resize->image_to_resize=$target_file;
                            $image_resize->ratio = true; // Keep Aspect Ratio?
                            $image_resize->dynamic_ratio = true; // Keep Aspect Ratio?

			// Name of the new image (optional) - If it's not set a new will be added automatically

                            $image_resize->new_image_name = $new_image_prefix;

			/* Path where the new image should be saved. If it's not set the script will output the image without saving it */

                            $image_resize->save_folder = ABSOLUTE_PATH.'/file_upload/estate_picture/prev/';
                            $thumb_process1 = $image_resize->resize();

                             //------- end for preview image -------//
                            
                            unlink($target_file);
                    }
                    
                }
                else {
                        
                    $modified_file_name=$f_textimage;
                }
                            
    
               //-------- end for file transfer ----------//
                
                
              //-------- start for add data in database ---------//
                
                $data=array(
                    'EstateTitle'=>$texttitle,
                    'EstateDetail'=>$textdescription,
                    'TransactionType'=>$selecttransaction,
                    'Price'=>$textprice,
                    'CountryId'=>$selectcountry,
                    'City'=>$textcity,
                    'TotalRoom'=>$texttotroom,
                    'TotalBathroom'=>$texttotbathroom,
                    'Surface'=>$textsurface,
                    'OtherUtility'=>$textutility,
                    'ImageName'=>$modified_file_name,
                    'SpecialStatus'=>$specialtatus,
                    'Status'=>$radiostatus
                  );
                
                
                
                $admin_estate->update_realestate($data,$estate_id);
                
                $session->success_msg="Data updated successfully";
                $this->_redirect('admin/edit-estate/'.$estate_id);
                        
             //-------- end for add data in database ---------//
           }
                
            
        }
        else // display the data from database
        {
             foreach($f_text_fileds as $k=>$v)
                    {
                        $this->view->$k=$v;
                    }
        }
        
       
                    
        Zend_Session::namespaceUnset('addestate'); // unset namespace
    }
    
    
    public function deleteestateAction()
    {
        //--------- start for authentication ------------//
            
             $auth = Zend_Auth::getInstance();
       
                if(!$auth->hasIdentity())
                {
                        $this->_redirect('admin');
                }
                
        //--------- end for authentication ------------//
                
                
        //----- start for model ------//
                      
            $admin_estate = new Model_Adminestate;
            
        //----- end for model -------//
            
        //----- start for fetch data from database ----//
            
            $estate_id=$this->getRequest ()->getParam ( 'estateid' );
            
            if($estate_id=="")
            {
                $this->_redirect(ROOT_PATH.'view-estate');
            }
                
        //----- end for fetch data from database ----// 
            
            $total_estate=$admin_estate->checkget_specific_realestate($estate_id);
            
            if($total_estate==0)
            {
                $this->_redirect(ROOT_PATH.'view-estate');
            }
            
            $estate_array=$admin_estate->get_specific_realestate($estate_id);
            
            
            $f_textimage=$estate_array['ImageName'];
            
            if($f_textimage!="")
                {
                    if(file_exists(ABSOLUTE_PATH.'/file_upload/estate_picture/thumb/' .$f_textimage))
                    {
                        unlink(ABSOLUTE_PATH.'/file_upload/estate_picture/thumb/' .$f_textimage);
                    }

                    if(file_exists(ABSOLUTE_PATH.'/file_upload/estate_picture/prev/' .$f_textimage))
                    {
                        unlink(ABSOLUTE_PATH.'/file_upload/estate_picture/prev/' .$f_textimage);
                    }

                }
                
                $admin_estate->delete_realestate($estate_id);
                
                $this->_helper->viewRenderer->setNoRender(true);
                
                $this->_redirect(ROOT_PATH.'admin/view-estate');
            
            
    }

 

}


?>