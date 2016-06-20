<?php

/**
 * Created by Alexandr Krivonos
 * Email: krausweb291985@gmail.com
 * Date: 3/26/16
 * Time: 5:29 PM
 */

// app/code/local/AKS/Training/Helper/Data.php
class AKS_Training_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * for <text helper="aks_training/data/getAlexData" />
     * in app/design/frontend/base/default/layout/aks/training.xml
     *
     * @return string
     */
    public function getAlexData()
    {
        return " --- Alex Data Helper Method 333 --- ";
    }

    public function getEmail()
    {
        return Mage::getStoreConfig('rm_dummymodule/rm_dummymodule/email');
    }
}