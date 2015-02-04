<?php

class Wage_Client_Block_Adminhtml_Report_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('survey_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('client')->__('Survey Summary'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('client')->__('Survey'),
          'title'     => Mage::helper('client')->__('Summary'),
          'content'   => $this->getLayout()->createBlock('client/adminhtml_report_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}
