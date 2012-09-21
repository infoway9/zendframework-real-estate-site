<?php

class Model_Estate extends Zend_Db_Table
{
    function display_normal_estate()
    {
       
         $db=$this->getAdapter();
         
        $select = $db->select();
        $select->from('estate_details',array('Id', 'EstateTitle', 'EstateDetail', 'Price', 'ImageName'));
        // Add a WHERE clause
       $select->where('SpecialStatus=?','0')
               ->where('Status=?','1');
       
       $select->order('AddedDate desc')
              ->limit(2,0);
        
       $result = $db->fetchAll($select);
        
        return $result;
    }
    
    function display_special_estate()
    {
       
        $db=$this->getAdapter();
         
        $select = $db->select();
        $select->from('estate_details',array('Id', 'EstateTitle', 'EstateDetail', 'Price', 'ImageName'));
        // Add a WHERE clause
       $select->where('SpecialStatus=?','1')
               ->where('Status=?','1');
       
       $select->order('AddedDate desc')
              ->limit(2,0);
        
       $result = $db->fetchAll($select);
        
        return $result;
    }
    
    function check_estate_details($id)
    {
        
        $db=$this->getAdapter();
        
        $select = $db->select();
        
        $select->from('estate_details', array('TotEstate'=>'count(*)'))
                ->where('Id=?',$id)
                ->where('Status=?','1');
        
        $numRows = $db->fetchRow($select);
        
       $val=$numRows['TotEstate'];
        
        
        return $val;
    }
    
    function estate_details($id)
    {
        $db=$this->getAdapter();
         
        $select = $db->select();
        $select->from(array('ed'=>'estate_details'),array('Id', 'EstateTitle', 'EstateDetail', 'Price', 'City', 'TotalRoom', 'TotalBathroom', 'Surface', 'OtherUtility', 'ImageName'));
        $select->join(array('cm'=>'country_master'),'ed.CountryId=cm.Id',array('CountryName'=>'Name'));
        // Add a WHERE clause
       $select->where('ed.Id=?',$id)
              ->where('ed.Status=?','1')
              ->where('cm.Status=?','1');
       
       $result = $db->fetchRow($select);
        
        return $result;
        
    }
    
    
}

?>