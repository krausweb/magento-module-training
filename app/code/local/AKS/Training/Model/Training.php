<?php
/**
 * Model Training
 *
 * @category    Local
 * @package     AKS_Training
 * @author      Alexandr Krivonos <krausweb291985@gmail.com>
 * @copyright   4/4/16 9:35 AM AKS
 *
 * @file        app/code/local/AKS/Training/Model/Training.php
 */

class AKS_Training_Model_Training extends Mage_Core_Model_Abstract
{
    /**
     * initialisation resource model
     * без этого не будет работать $this->save(); !!!
     */
    protected function _construct(){
        //// the initialization for fork with DB
        // the path to the - app/code/local/AKS/Training/Model/Training.php
        $this->_init("aks_training/training"); // /training == /Training.php !!!
    }
}