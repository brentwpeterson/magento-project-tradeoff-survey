<?php
class Wage_Client_Block_Adminhtml_Report_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected $_countTotals = true;

    public function __construct()
    {
        parent::__construct();
        $this->setId('clientGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('client/survey')->getCollection();

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('id', array(
            'header'    => Mage::helper('client')->__('Survey #'),
            'align'     =>'left',
            'width'     => '50px',
            'type'      => 'number',
            'index'     => 'id',
        ));

        $this->addColumn('email', array(
            'header'    => Mage::helper('client')->__('User Email'),
            'index'     => 'email',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('client')->__('User Name'),
            'index'     => 'name',
        ));

        $this->addColumn('cost', array(
            'header'    => Mage::helper('client')->__('Cost'),
            'index'     => 'cost',
            'renderer'  => 'Wage_Client_Block_Adminhtml_Report_Renderer_Appendcomment',
            'filter'    => false,
        ));

        $this->addColumn('duration', array(
            'header'    => Mage::helper('client')->__('Duration'),
            'index'     => 'duration',
            'renderer'  => 'Wage_Client_Block_Adminhtml_Report_Renderer_Appendcomment',
            'filter'    => false,
        ));

        $this->addColumn('user_adoption', array(
            'header'    => Mage::helper('client')->__('User Adoption'),
            'index'     => 'user_adoption',
            'renderer'  => 'Wage_Client_Block_Adminhtml_Report_Renderer_Appendcomment',
            'filter'    => false,
        ));

        $this->addColumn('project_goals', array(
            'header'    => Mage::helper('client')->__('Project Goals'),
            'index'     => 'project_goals',
            'renderer'  => 'Wage_Client_Block_Adminhtml_Report_Renderer_Appendcomment',
            'filter'    => false,
        ));

        $this->addColumn('certainty', array(
            'header'    => Mage::helper('client')->__('Certainty'),
            'index'     => 'certainty',
            'renderer'  => 'Wage_Client_Block_Adminhtml_Report_Renderer_Appendcomment',
            'filter'    => false,
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('client')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('client')->__('XML'));

        return parent::_prepareColumns();
    }



    public function getRowUrl($row)
    {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    public function getTotals()
    {
        $totals = new Varien_Object();
        $fields = array(
            'cost' => 0,
            'duration' => 0,
            'user_adoption' => 0,
            'project_goals' => 0,
            'certainty' => 0,
        );

        foreach ($this->getCollection() as $item) {
            foreach($fields as $field=>$value){
                $fields[$field] += $item->getData($field);
            }
        }

        $fields['entity_id']='Totals';
        $totals->setData($fields);
        return $totals;
    }

}
