<?php
class Wage_Client_Adminhtml_ReportController extends Mage_Adminhtml_Controller_Action {
    /**
     * magento Report for survey
     * @author atheotsky
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->_title($this->__("Survey Report"));
        $this->renderLayout();
    }

	public function editAction() {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('client/survey')->load($id);

		if ($model->getId()) {
			Mage::register('survey', $model);

			$this->loadLayout();
			$this->_setActiveMenu('sales/client');

			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Wagento'), Mage::helper('adminhtml')->__('Survey Manager'));

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

			$this->_addContent($this->getLayout()->createBlock('client/adminhtml_report_edit'))
				->_addLeft($this->getLayout()->createBlock('client/adminhtml_report_edit_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('client')->__('Survey does not exist'));
			$this->_redirect('*/*/');
		}
	}

    /**
     * save survey content from the edit form
     * @author atheotsky
     */
    public function saveAction()
    {
        $post_data = $this->getRequest()->getPost();

        try {
            $survey = Mage::getModel('client/survey')->load($post_data['id']);

            $survey->setData($post_data);
            $survey->save();

            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('client')->__('Survey was successfully saved.'));
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }

        $this->_redirect('*/*/');
    }

    public function exportCsvAction()
    {
        $fileName   = 'survey.csv';
        $content    = $this->getLayout()->createBlock('client/adminhtml_report_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'survey.xml';
        $content    = $this->getLayout()->createBlock('client/adminhtml_report_grid')
            ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK','');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('codebase/client/report');
    }
}
