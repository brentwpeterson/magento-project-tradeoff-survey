<?php
class Wage_Client_Block_Adminhtml_Report extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_report';
    $this->_blockGroup = 'client';
    $this->_headerText = Mage::helper('client')->__('Survey Report');
    parent::__construct();
    $this->_removeButton('add');
  }
}
