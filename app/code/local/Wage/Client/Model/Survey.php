<?php
class Wage_Client_Model_Survey extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('client/survey');
    }

    public function loadSurveyByEmail($email) {
        $collection = $this->getCollection()->addFieldToFilter('email', $email);
        return $collection->getFirstItem();
    }
}
