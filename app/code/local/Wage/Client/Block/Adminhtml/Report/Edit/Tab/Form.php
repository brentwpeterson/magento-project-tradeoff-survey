<?php
class Wage_Client_Block_Adminhtml_Report_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $points = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('survey_form', array('legend'=>Mage::helper('client')->__('Team Information')));

        $fieldset->addField('email', 'hidden', array( 'name'      => 'email',));
        $fieldset->addField('id', 'hidden', array( 'name'      => 'id',));
        $fieldset->addField('name', 'hidden', array( 'name'      => 'name',));
        $fieldset->addField('position', 'hidden', array( 'name'      => 'position',));

        $fieldset->addField('cost', 'select', array(
            'label'     => Mage::helper('client')->__('Cost'),
            'required'  => true,
            'name'      => 'cost',
            'values' => $points,
        ));

        $fieldset->addField('cost_comment', 'text', array(
            'label'     => Mage::helper('client')->__('Cost Comment'),
            'name'      => 'cost_comment',
        ));

        $fieldset->addField('duration', 'select', array(
            'label'     => Mage::helper('client')->__('Duration'),
            'required'  => true,
            'name'      => 'duration',
            'values' => $points,
        ));

        $fieldset->addField('duration_comment', 'text', array(
            'label'     => Mage::helper('client')->__('Duration Comment'),
            'name'      => 'duration_comment',
        ));

        $fieldset->addField('user_adoption', 'select', array(
            'label'     => Mage::helper('client')->__('User Adoption'),
            'required'  => true,
            'name'      => 'user_adoption',
            'values' => $points,
        ));

        $fieldset->addField('user_adoption_comment', 'text', array(
            'label'     => Mage::helper('client')->__('User Adoption Comment'),
            'name'      => 'user_adoption_comment',
        ));

        $fieldset->addField('project_goals', 'select', array(
            'label'     => Mage::helper('client')->__('Project Goals'),
            'required'  => true,
            'name'      => 'project_goals',
            'values' => $points,
        ));

        $fieldset->addField('project_goals_comment', 'text', array(
            'label'     => Mage::helper('client')->__('Project Goals Comment'),
            'name'      => 'project_goals_comment',
        ));


        $fieldset->addField('certainty', 'select', array(
            'label'     => Mage::helper('client')->__('Certainty'),
            'required'  => true,
            'name'      => 'certainty',
            'values' => $points,
        ));

        $fieldset->addField('certainty_comment', 'text', array(
            'label'     => Mage::helper('client')->__('Certainty Comment'),
            'name'      => 'certainty_comment',
        ));


        if ( Mage::getSingleton('adminhtml/session')->getSurveyData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getSurveyData());
            Mage::getSingleton('adminhtml/session')->setSurvey(null);
        }
        elseif (Mage::registry('survey') ) {
            $form->setValues(Mage::registry('survey')->getData());
        }

        return parent::_prepareForm();
    }
}
