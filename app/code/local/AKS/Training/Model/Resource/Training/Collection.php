<?php

/**
 * Description Adminhtml Resource Collection
 *
 * @category    Local
 * @package     AKS_Training
 * @author      Alexandr Krivonos <krausweb291985@gmail.com>
 * @copyright   3/29/16 9:32 PM AKS
 *
 * @file        app/code/local/AKS/Training/Model/Resource/Training/Collection.php
 */

class AKS_Training_Model_Resource_Training_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct(){
        parent::_construct();
        // инициализация класса коллекции объектов, в конструкторе которой - происходит инициализация исходной модели AKS_Training_Model_Training
        $this->_init("aks_training/training");
    }
}