<?php

class Model_Estatesearch extends Zend_Db_Table
{
    private $trans_type_id;
    
    function tot_estate_list($trans_type_id)
    {
        
        
        $this->trans_type_id=$trans_type_id;
        
         $db=$this->getAdapter();
         
        $select = $db->select();
        $select->from(array('ed'=>'estate_details'),array('TotProduct'=>'count(ed.Id)'));
        $select->join(array('cm'=>'country_master'),'ed.CountryId=cm.Id',array());
        // Add a WHERE clause
       $select->where('ed.TransactionType=?',$this->trans_type_id)
              ->where('ed.Status=?','1')
              ->where('cm.Status=?','1');
      
       
              
        $result = $db->fetchRow($select);
        $val=$result['TotProduct'];
        
        return $val;
    }
        
    function estate_list($trans_type_id,$city,$price,$price_to,$rooms)
    {
                
         $db=$this->getAdapter();
         
        $select = $db->select();
        $select->from(array('ed'=>'estate_details'),array('Id', 'EstateTitle', 'EstateDetail', 'TransactionType', 'Price', 'City', 'TotalRoom', 'TotalBathroom', 'Surface', 'OtherUtility', 'ImageName'));
        $select->join(array('cm'=>'country_master'),'ed.CountryId=cm.Id',array('CountryName'=>'Name'));
        // Add a WHERE clause
        
        if($trans_type_id!="")
        {
            $select->where('ed.TransactionType=?',$trans_type_id);
        }
        
       $select->where('ed.Status=?','1')
              ->where('cm.Status=?','1');
       
       if($city!="")
       {
           $select->where('ed.City like ?', "%$city%");
       }
       
       if(is_numeric($price))
       {
           $select->where('ed.Price >= ?',$price);
       }
       
       if(is_numeric($price_to))
       {
           $select->where('ed.Price <= ?',$price_to);
       }
        
       if(is_numeric($rooms))
       {
           $select->where('ed.TotalRoom >= ?',$rooms);
       } 
       
       $select->order(array('ed.Price ASC'));
       
       return $select;
    }
}

?>