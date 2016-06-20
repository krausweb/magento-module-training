<?php
/**
 * Created by Alexandr Krivonos
 * Email: krausweb291985@gmail.com
 * Date: 23/03/16
 * Time: 4:21 PM
 *
 * Add additional field in DB
 */


$installer = $this;
// НАЧАЛО установки
$installer->startSetup();


// table object
$table_obj = $installer->getTable('aks/training');

// Добавление новой колонки
$installer->run("ALTER TABLE ".$table_obj."
                    ADD COLUMN entity_is_active INT(1) NOT NULL DEFAULT 1 AFTER entity_date");
$installer->run("ALTER TABLE ".$table_obj."
                  ADD INDEX idx_entity_is_active USING BTREE (entity_is_active ASC) ");

/* // not work
$installer->getConnection()
    ->addColumn('entity_is_active', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array('nullable'  => false))
    ->addIndex('idx_entity_is_active', 'entity_is_active');
*/


// Insert default value (for test)
$installer->run("INSERT INTO ".$table_obj."
                              ( entity_name, entity_date, entity_is_active)
                            VALUE('TEST Data', ".time().", 0) ");


// КОНЕЦ установки
$installer->endSetup();