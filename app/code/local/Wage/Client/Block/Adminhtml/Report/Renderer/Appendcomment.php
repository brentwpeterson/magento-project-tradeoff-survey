<?php
class Wage_Client_Block_Adminhtml_Report_Renderer_Appendcomment extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        return $this->_getValue($row);
    }

    protected function _getValue(Varien_Object $row)
    {      
        $val = "<b>{$row->getData($this->getColumn()->getIndex())}</b>";
        if ($row->getData($this->getColumn()->getIndex().'_comment')) {
            $val .= "<br /><b>Comment</b> : {$row->getData($this->getColumn()->getIndex().'_comment')}";
        }

        return $val;
    }
}
