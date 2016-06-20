<?php
/**
 * Created by Alexandr Krivonos
 * Email: krausweb291985@gmail.com
 * Date: 24/03/16
 * Time: 4:21 PM
 */


$installer = Mage::getResourceModel("catalog/setup", "default_setup");
// OR ~ $installer = new Mage_Eav_Model_Entity_Setup('core_setup');

// НАЧАЛО установки
$installer->startSetup();



///// Переименование таба "AKS Tab" - на "AKS". Для админки

// http://site.com.local/index.php/admin/catalog_product/ -
// Каталог --- Управление товарами --- "Редакция товара" --- Таб "AKS Tab" в "AKS" и другие обновления Заголовков

// attribute_code --- akstab --> aks
$installer->updateAttribute('catalog_product', 'akstab', "attribute_code", "aks");
// BEFORE frontend_label --- AKS Tab --> AKS
$installer->updateAttribute('catalog_product', 'aks', "frontend_label", "AKS");

// attribute_code --- akstabtitle --> akstitle
$installer->updateAttribute('catalog_product', 'akstabtitle', "attribute_code", "akstitle");
// BEFORE frontend_label --- AKS Title --> AKS
$installer->updateAttribute('catalog_product', 'akstitle', "frontend_label", "AKS Title");



// КОНЕЦ установки
$installer->endSetup();