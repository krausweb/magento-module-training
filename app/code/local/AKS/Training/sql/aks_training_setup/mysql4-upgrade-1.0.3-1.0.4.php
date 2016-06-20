<?php
/**
 * Created by Alexandr Krivonos
 * Email: krausweb291985@gmail.com
 * Date: 24/03/16
 * Time: 4:21 PM
 *
 * Remove old Tab
 */


$installer = Mage::getResourceModel("catalog/setup", "default_setup");
// OR ~ $installer = new Mage_Eav_Model_Entity_Setup('core_setup');

// НАЧАЛО установки
$installer->startSetup();



///// Удаление таба "AKS Tab" - на "AKS". Для админки


// Delete All "aks" Attribute group
$installer->removeAttributeGroup('catalog_product', 'Default', 'aks');
// Delete Children attribute in "aks" attribute
$installer->removeAttribute('catalog_product', 'aks');
$installer->removeAttribute('catalog_product', 'akstitle');



/*
// Remove Customer Attribute - for Example
$installer->removeAttribute('customer', 'customer_attribute_code');
 */

// КОНЕЦ установки
$installer->endSetup();