<?php
/**
 * Description
 *
 * @category    Local
 * @package     AKS_Training
 * @author      Alexandr Krivonos <krausweb291985@gmail.com>
 * @copyright   8/4/16 9:35 AM AKS
 *
 * @var         $this
 * @file        app/code/local/AKS/Training/sql/aks_training_setup/mysql4-upgrade-1.0.6-1.0.7.php
 */


//$installer = Mage::getResourceModel("catalog/setup", "default_setup");
// OR ~ $installer = new Mage_Eav_Model_Entity_Setup('core_setup');

// НАЧАЛО установки
//$installer->startSetup();

// Add TinyMCE for "akstab" textarea
$eavConfig = Mage::getSingleton('eav/config');
//$attribute_2 = $eavConfig->getAttribute('catalog_product', 'aks');
//$attribute_2->setData('is_wysiwyg_enabled', 1);
//$attribute_2->save();

// КОНЕЦ установки
//$installer->endSetup();