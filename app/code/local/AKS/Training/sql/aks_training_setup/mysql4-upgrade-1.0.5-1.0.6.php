<?php
/**
 * Created by Alexandr Krivonos
 * Email: krausweb291985@gmail.com
 * Date: 24/03/16
 * Time: 4:21 PM
 *
 * Create new Multiselect section - aks_progr_list
 */


$installer = Mage::getResourceModel("catalog/setup", "default_setup");
// OR ~ $installer = new Mage_Eav_Model_Entity_Setup('core_setup');

// НАЧАЛО установки
$installer->startSetup();



///// Создание Мультивыбора/списка для "AKS" таба. Для админки

// http://site.com.local/index.php/admin/catalog_product/ -
// Каталог --- Управление товарами --- "Редакция товара" --- появится новая вкладка "AKS List of programming languages" в таб "AKS"
$installer->addAttribute('catalog_product', 'aks_progr_list', array(
    'group'         => 'AKS',
    'input'         => 'multiselect',
    'type'          => 'varchar',
    'label'         => 'AKS List of programming languages',
    // нужно чтобы в админке при сохранении в мультиселекте ОТОБРАЖАЛИСЬ данные(по сути чтобы функционал работал)
    // применаю стандартную EAV модель/класс (eav/entity_attribute_backend_array)
    'backend'       => 'eav/entity_attribute_backend_array',
    // указываю путь к СВОЕЙ EAV модели (AKS модель/вендор) чтобы сразу в модели - задать верстку/дизайн отображения блока
    'frontend'      => 'aks/entity_attribute_frontend_list',
    'visible'       => 1,
    'required'      => 0,
    'user_defined' => 1,
    'searchable' => 0,
    'filterable' => 0,
    'comparable'    => 0,
    'visible_on_front' => 1,            // разрешить отображать на frontend
    'visible_in_advanced_search'  => 0,
    'is_html_allowed_on_front' => 1,    // разрешить html в коде
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    // дополнительные варианты добавляем в
    // http://site.com.local/index.php/admin/catalog_product_attribute/edit/attribute_id/ID_YOUR_ATTRIBUTE/
    // Админка --- Каталог --- Атрибуты --- Управление атрибутами --- "выбираем нужный атрибут" ---
    // --- Управление заголовками / вариантами --- Управление вариантами (значения вашего атрибута) --- Добавить вариант
    'option' => array(
        'order' => array('one'=>1, 'two'=>2, 'three'=>3),
        'value' => array(
            'one'=>array(0=>'Label: C++', 1=>'C++'),
            'two'=>array(0=>'Label: PHP', 1=>'PHP'),
            'three'=>array(0=>'Label: JS', 1=>'JS')
        ),
    )
));



// КОНЕЦ установки
$installer->endSetup();