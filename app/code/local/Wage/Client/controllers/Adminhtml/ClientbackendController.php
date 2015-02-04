<?php
class Wage_Client_Adminhtml_ClientbackendController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $user = Mage::getSingleton('admin/session')->getUser(); 
        $survey = Mage::getModel('client/survey')->loadSurveyByEmail($user->getEmail());
        if ($survey->getId()) {
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('client')->__('Congratulation ! Your survey has been filled, but you can still update it now.'));
        }

        $this->loadLayout();
        $this->_title($this->__("Start Your Survey"));
        $this->renderLayout();
    }

    /**
     * save survey content for current admin
     * @author atheotsky
     */
    public function saveAction()
    {
        $user = Mage::getSingleton('admin/session')->getUser(); 
        $post_data = $this->getRequest()->getPost();

        try {
            $survey = Mage::getModel('client/survey')->loadSurveyByEmail($user->getEmail());
            if ($survey->getId()) $post_data['id'] = $survey->getId();

            $survey->setData($post_data);
            $survey->setName($user->getName());
            $survey->setEmail($user->getEmail());

            $survey->save();

            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('client')->__('Survey was successfully saved. Thank you!'));
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }

        $this->_redirect('*/*/');
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('codebase/client/survey');
    }
}
