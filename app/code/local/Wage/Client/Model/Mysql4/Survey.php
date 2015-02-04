<?php
class Wage_Client_Model_Mysql4_Survey extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        $this->_init('client/survey', 'id');
    }
}
