<?php

class Model_Adminestate extends Zend_Db_Table
{
      
        
    function add_realestate($data)
    {
                
         $db=$this->getAdapter();
         
        $db->insert('estate_details',$data);
    }
    
    function update_realestate($data,$id)
    {
                
         $db=$this->getAdapter();
         
        $db->update('estate_details',$data,"Id='$id'");
    }
    
    function delete_realestate($id)
    {
                
         $db=$this->getAdapter();
         
        $db->delete('estate_details',"Id='$id'");
    }
    
    
    function get_realestate()
     {
         
         
         $db=$this->getAdapter();
         $select = $db->select();
         $select->from('estate_details')
                ->order('AddedDate');
         
         
              
        return $select;
     }
     
     function checkget_specific_realestate($id)
     {
         
         
         $db=$this->getAdapter();
         $select = $db->select();
         $select->from('estate_details',array('Totalestate'=>'count(Id)'))
                ->where('Id=?',$id);
         
        $result = $db->fetchRow($select);
        
        $result=$result['Totalestate'];
              
        return $result;
     }
     
      function get_specific_realestate($id)
     {
         
         
         $db=$this->getAdapter();
         $select = $db->select();
         $select->from('estate_details')
                ->where('Id=?',$id);
         
        $result = $db->fetchRow($select);
        
              
        return $result;
     }
}

?>