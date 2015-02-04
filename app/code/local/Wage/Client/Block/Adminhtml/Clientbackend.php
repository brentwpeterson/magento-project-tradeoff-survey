<?php  
class Wage_Client_Block_Adminhtml_Clientbackend extends Mage_Adminhtml_Block_Template {
    public function getSurveyJson() {
        $user = Mage::getSingleton('admin/session')->getUser(); 

        $survey = Mage::getModel('client/survey')->loadSurveyByEmail($user->getEmail())->getData();
        if (!empty($survey)) {
            $survey['email'] = $user->getEmail();
            $survey['name'] = $user->getName();

            return json_encode($survey);
        }
        else {
            return null;
        }
    }
}
