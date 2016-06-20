<?php
/**
 * Created by Alexandr Krivonos
 * Email: krausweb291985@gmail.com
 * Date: 24/03/16
 * Time: 4:21 PM
 *
 * Add attribute akstab and akstitle for product in Adminhtml and Fronted (in DB.eav_attribute !!!)
 */


$installer = Mage::getResourceModel("catalog/setup", "default_setup");
// НАЧАЛО установки
$installer->startSetup();



///// Добавление Нового атрибута при заполнении товара в админке

// Create "akstab" Attribute group (это не обязательно, он создастся автоматически при добавлении в него нового значения)
// 'Default' - тип товара (простой, НЕ сводный/групповой и т.д.)
$installer->addAttributeGroup('catalog_product', 'Default', 'akstab', 1000);

// http://site.com.local/index.php/admin/catalog_product/ -
// Каталог --- Управление товарами --- "Редакция товара" --- появится новый таб "AKS Tab"
$installer->addAttribute('catalog_product', 'akstab', array(
    'group'         => 'AKS Tab',
    'input'         => 'textarea',
    'type'          => 'text',
    'label'         => 'AKS Tab',
    'backend'       => '',
    'visible'       => 1,
    'required'      => 0,
    'user_defined' => 1,
    'searchable' => 0,
    'filterable' => 0,
    'comparable'    => 0,
    'visible_on_front' => 1,
    'visible_in_advanced_search'  => 0,
    'is_html_allowed_on_front' => 0,
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    // добавляю дефолтные данные - НО они будут добавлять только для Новых товаров, тоесть при создании нового товара!
    'default'       => 'Текст по умолчанию'
));

// появится в Табе "AKS Tab" новое input поле "AKS Tab Title"
$installer->addAttribute('catalog_product', 'akstabtitle', array(
    'group'         => 'AKS Tab',
    'input'         => 'text',
    'type'          => 'text',
    'label'         => 'AKS Tab Title',
    'backend'       => '',
    'visible'       => 1,
    'required'      => 0,
    'user_defined' => 1,
    'searchable' => 0,
    'filterable' => 0,
    'comparable'    => 0,
    'visible_on_front' => 1,
    'visible_in_advanced_search'  => 0,
    'is_html_allowed_on_front' => 0,
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    // добавляю дефолтные данные - НО они будут добавлять только для Новых товаров, тоесть при создании нового товара!
    'default'       => 'Title'
));



// КОНЕЦ установки
$installer->endSetup();