<?php
/**
 * Created by Alexandr Krivonos
 * Email: krausweb291985@gmail.com
 * Date: 24/03/16
 * Time: 4:21 PM
 *
 * Create new Correct tab + TinyMCE
 */


$installer = Mage::getResourceModel("catalog/setup", "default_setup");
// OR ~ $installer = new Mage_Eav_Model_Entity_Setup('core_setup');

// НАЧАЛО установки
$installer->startSetup();



///// Создание на чистую Нового, уже "AKS" таба. Для админки


// Create "akstab" Attribute group (это не обязательно, он создастся автоматически при добавлении в него нового значения)
// 'Default' - тип товара (простой, НЕ сводный/групповой и т.д.)
$installer->addAttributeGroup('catalog_product', 'Default', 'aks', 1000);

// http://site.com.local/index.php/admin/catalog_product/ -
// Каталог --- Управление товарами --- "Редакция товара" --- появится новый таб "AKS"
$installer->addAttribute('catalog_product', 'aks', array(
    'group'         => 'AKS',
    'input'         => 'textarea',
    'type'          => 'text',
    'label'         => 'AKS',
    'backend'       => '',
    'visible'       => 1,
    'required'      => 0,
    'user_defined' => 1,
    'searchable' => 0,
    'filterable' => 0,
    'comparable'    => 0,
    'visible_on_front' => 1,
    'visible_in_advanced_search'  => 0,
    'is_html_allowed_on_front' => 1,
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
));

// появится в Табе "AKS" новое input поле "AKS Title"
$installer->addAttribute('catalog_product', 'akstitle', array(
    'group'         => 'AKS',
    'input'         => 'text',
    'type'          => 'text',
    'label'         => 'AKS Title',
    'backend'       => '',
    'visible'       => 1,
    'required'      => 0,
    'user_defined' => 1,
    'searchable' => 0,
    'filterable' => 0,
    'comparable'    => 0,
    'visible_on_front' => 1,
    'visible_in_advanced_search'  => 0,
    'is_html_allowed_on_front' => 1,
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
));

// добавляю дефолтные данные - НО они будут добавлять только для Новых товаров, тоесть при создании нового товара!
$installer->updateAttribute('catalog_product', "akstitle", "default_value", "Title");


// Add TinyMCE for "akstab" textarea
$eavConfig = Mage::getSingleton('eav/config');
$attribute_2 = $eavConfig->getAttribute('catalog_product', 'aks');
$attribute_2->setData('is_wysiwyg_enabled', 1);
$attribute_2->save();

// КОНЕЦ установки
$installer->endSetup();