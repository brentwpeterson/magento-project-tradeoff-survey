<?php
class Wage_Client_Block_Adminhtml_Report_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'client';
        $this->_controller = 'adminhtml_report';
        
        $this->_updateButton('save', 'label', Mage::helper('client')->__('Save Survey'));
    }

    public function getHeaderText()
    {
        if( Mage::registry('survey') && Mage::registry('survey')->getId() ) {
            return Mage::helper('client')->__("Edit Survey No. %s", $this->htmlEscape(Mage::registry('survey')->getId()));
        } else {
            return Mage::helper('client')->__('Add Survey');
        }
    }
}
