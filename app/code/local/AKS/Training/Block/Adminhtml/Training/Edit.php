<?php

/**
 * Description Adminhtml Block Grid/Form Edit
 *
 * @category    Local
 * @package     AKS_Training
 * @author      Alexandr Krivonos <krausweb291985@gmail.com>
 * @copyright   3/29/16 9:32 PM AKS
 *
 * @file        app/code/local/AKS/Training/Block/Adminhtml/Training/Edit.php
 */

class AKS_Training_Block_Adminhtml_Training_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    //protected function _prepareLayout(){}

    protected function _construct()
    {
        $this->_blockGroup = 'aks_training';
        $this->_controller = 'adminhtml_training';
    }

    public function getHeaderText()
    {
        $helper = Mage::helper('aks_training');
        $model = Mage::registry('current_training');

        if ($model->getEntityId()) {
            return $helper->__("Edit name item '%s'", $this->escapeHtml($model->getEntityName()));
        } else {
            return $helper->__("Add new item");
        }
    }
}