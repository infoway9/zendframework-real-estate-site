<?php

class Model_Others extends Zend_Db_Table
{
    
     function get_country()
     {
         
         
         $db=$this->getAdapter();
         $select = $db->select();
         $select->from('country_master',array('Id','Name'))
                ->where('Status=?','1')
                ->order('Name');
         
        $result = $db->fetchAll($select);
        
              
        return $result;
     }
     
       
    function add_realestate($data)
    {
        print_r($data);
                exit;
         $db=$this->getAdapter();
         
        $db->insert('estate_details',$data);
    }
       
}

?>