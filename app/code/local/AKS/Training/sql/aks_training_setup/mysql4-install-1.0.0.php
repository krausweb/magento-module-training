<?php
/**
 * Created by Alexandr Krivonos
 * Email: krausweb291985@gmail.com
 * Date: 22/03/16
 * Time: 4:21 PM
 *
 * Create table and set default data for DB
 */


$installer = $this;
// НАЧАЛО установки
$installer->startSetup();


// table object
$table_model = $installer->getTable('aks/training');

// для удаления старой таблицы
$installer->getConnection()->dropTable($table_model);

// создаем структуру новой таблицы
$table = $installer->getConnection()
    ->newTable($table_model)
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array('identity'  => true,
                                                                                   'nullable'  => false,
                                                                                   'primary'   => true))
    ->addColumn('entity_name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array('nullable'  => false,
                                                                                      'unique' => true))
    ->addColumn('entity_date', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array('nullable'  => false))

    ->addIndex('idx_entity_name', 'entity_name')
    ->addIndex('idx_entity_date', 'entity_date');

// само создание таблицы
$installer->getConnection()->createTable($table);

// это будет работать только в для БД типа InnoDB
$table = $installer->run("INSERT INTO aks_training
                                  ( entity_name, entity_date)
                                VALUE('Тестовое название', ".time().") ");



// КОНЕЦ установки
$installer->endSetup();