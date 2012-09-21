<?php

class Model_Admina extends Zend_Db_Table
{
    protected $_name = 'admin';
    
    function log_in($user_name)
    {
              
        $db=$this->getAdapter();
        
        $select = $db->select();
        $select->from('admin');
        
       $select->where('UserName=?',$user_name);
        
       $result = $db->fetchAll($select);
        
        return $result;
       
    }
        
}

?>