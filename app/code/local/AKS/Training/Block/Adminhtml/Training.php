<?php

/**
 * Description Adminhtml Block
 *
 * @category    Local
 * @package     AKS_Training
 * @author      Alexandr Krivonos <krausweb291985@gmail.com>
 * @copyright   3/29/16 9:32 PM AKS
 *
 * @file        app/code/local/AKS/Training/Block/Adminhtml/Training.php
 */

class AKS_Training_Block_Adminhtml_Training extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function _construct(){
        parent::_construct();

        $helper = Mage::helper("aks_training");
        $this->_blockGroup = "aks_training";
        $this->_controller = "adminhtml_training";

        $this->_headerText = $helper->__("TEST");
        $this->_addButtonLabel = $helper->__("Create field");
    }
}