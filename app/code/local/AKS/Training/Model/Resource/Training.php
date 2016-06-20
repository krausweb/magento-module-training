<?php
/**
 * Resource model for work with DB !!!
 *
 * @category    Local
 * @package     AKS_Training
 * @author      Alexandr Krivonos <krausweb291985@gmail.com>
 * @copyright   4/4/16 9:35 AM AKS
 *
 * @file        app/code/local/AKS/Training/Model/Resource/Training.php
 */

class AKS_Training_Model_Resource_Training extends Mage_Core_Model_Mysql4_Abstract
{
    /**
     * initialization table DB for work with $this->save();
     */
    public function _construct(){
        // первым параметром является путь к названию нужной таблицы,
        // а вторым — поле, использующееся в качестве первичного ключа (PRIMARY KEY) таблицы
        // в Resource !!! этот путь это узел модуля и узел таблицы, а НЕ путь к модель в отличии от класса модели
        // То-есть (<!-- <aks_training> -> ... -> <aks_training>-->) -
        /* config.xml
        <models>
            <aks_training> --> этот УЗЕЛ
                ...
            </aks_training>
            <aks_training_resource>
                ...
                <entities>
                    <aks_training> ---> плюс этот УЗЕЛ
                        <table>aks_training</table>
                    </aks_training>
                </entities>
            </aks_training_resource>
        </models>
        */
        $this->_init("aks_training/aks_training", "entity_id");
    }
}