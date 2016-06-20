<?php

/**
 * Description
 *
 * @category    Local
 * @package     AKS_Training
 * @author      Alexandr Krivonos <krausweb291985@gmail.com>
 * @copyright   3/29/16 9:32 PM AKS
 *
 * @var         $this Mage_Core_Controller_Front_Action Mage_Core_Controller_Varien_Action Varien_Data_Collection_Db
 * @file        app/code/local/AKS/Training/controllers/IndexController.php
 */

class AKS_Training_IndexController extends Mage_Core_Controller_Front_Action
{

    /************************************ TEST|DEBUG|EXAMPLE ***************************************************** */

    /**
     * load default layout
     */
    public function indexAction(){
        // http://site.com.local/training/index/default



        /*$handle = $this->loadLayout()->renderLayout();
        $model = Mage::getModel('aks_training/training');
        Zend_Debug::dump( $handle->getHandles() );
        // or
        $this->getLayout()->getUpdate()->getHandles();
        exit;*/


        $this->loadLayout();
        $this->getLayout()->getBlock('content')->toHtml('<p>TEST</p>');
        $this->renderLayout();
    }

    /**
     * example all get layout info and Logging to a file
     */
    public function layoutAction(){
        // http://site.com.local/training/index/layout
        $xml = $this->loadLayout()->getLayout()->getUpdate()->asString();
        $this->getResponse()->setHeader("Content-type", "text/plain")->setBody($xml);

        //Mage::log($xml, Zend_Log::INFO, "layout.log", true);
        $model = Mage::getModel('aks_training/training');

        Mage::log($model, Zend_Log::INFO, "model.log", true);

    }

    /**
     * example all get layout info and Logging to a file - Two version
     */
    public function layoutTwoAction(){
        // http://site.com.local/training/index/layout
        $this->loadLayout();
        header("Content-type: text-xml");
        exit( $this->getLayout()->getNode()->asXML() );
        $this->renderLayout();
    }

    /**
     * Select with DB, get Category Id and Name
     */
    public function categoryAction(){
        // db.catalog_category_entity - default
        // db.catalog_category_entity_varchar - field - value = name (getName // ->addAttributeToSelect("name") )
        // db.catalog_category_entity.level - level (->addFieldToFilter("field", чему_будет_равно) )
        // where "catalog_category_entity.entity_id = catalog_category_entity_varchar.entity_id"
        // ->addOrder('name',"ASC"); - ORDER BY `name` ASC ()

        // for cool check --- if( $collection instanceof Varien_Data_Collection_Db ) { ... }
        $categories = Mage::getResourceModel("catalog/category_collection")
            ->addFieldToFilter('level', 2)
            ->addAttributeToSelect("name")
            ->addOrder('name', Varien_Db_Select::SQL_ASC);

        foreach($categories as $category){
            //Zend_Debug::dump($category);
            echo "<p>".$category->getId() ." - ". $category->getName()."</p>";
        }
    }

    /**
     * вернуть все данные которые относятся к таблице КАТегорий
     */
    public function categoryFieldAction($load_level = 1){
        // http://site.com.local/training/index/categoryfield

        $load_level = (isset($_GET["ll"]) and $_GET["ll"]) ? $_GET["ll"] : $load_level;
        // выборка с БД категорий с level 1 ("2")
        $categories = Mage::getResourceModel("catalog/category_collection")
            ->addFieldToFilter('level', $load_level);

        foreach($categories as $category) {

            // вытянет ID всех дочерних категорий в формате (3,4,5)
            $children   = $category->getChildren();
            // разбиваем в массив чтобы потом удобно перебрать в цикле
            $childrenId = explode(",", $children);

            // для каждой категории - вытягиваем все значения из полей из БД в формате "поле=значение"
            foreach ($childrenId as $child) {
                $child = Mage::getModel("catalog/category")->load($child);
                Zend_Debug::dump( $child->debug() );
            }
        }
    }

    /**
     * вернуть все данные которые относятся к таблице КАТегорий через Collection(версия 2)
     */
    public function categoryFieldCollectionAction(){
        // http://site.com.local/training/index/categoryfieldcollection

        $categories = Mage::getModel("catalog/category")->getCollection()
                                        ->addAttributeToSelect(array("url_key", "name"))
                                        ->addFieldToFilter("name", array("like","Daikin"));

        foreach($categories as $category) {
            //$category->getName();
            Zend_Debug::dump( $category->debug() );
        }
    }


    /**
     * save Data in DB
     * add new Category
     */
    public function saveAction(){
        $model = Mage::getModel("catalog/category");
        $model->setName("Test");
        $model->setDescription("Тестовое описание категории");
        $model->setIsActive(1);
        //$model->setParentId(2);
        //$model->setLevel(2);
        $model->save();

        //Zend_Debug::dump($model->debug());
    }

    /**
     * delete Data in DB
     * delete category (->load(5) - category_id = 5)
     */
    public function deleteAction(){
        $model = Mage::getModel("catalog/category");
        //$model = Mage::getModel("customer/customer");
        $model->load(5);
        $model->delete();

        //Zend_Debug::dump($model);
    }


    /**
     * вернуть все данные которые относятся к таблице ПОЛьзователей
     * $child = Mage::getModel("customer/customer")->load($customer->getId());
     */
    public function customerAction(){
        // http://site.com.local/training/index/customer

        // выборка с БД + lastname
        $customers = Mage::getResourceModel("customer/customer_collection")
            // нет в главной таблице - поэтому дополнительно добавляем к выборке(это своего рода LEFT JOIN)
            ->addAttributeToSelect("lastname");
            //->addAttributeToSelect("firstname");

        foreach($customers as $customer) {
            //Zend_Debug::dump( $customer->getLastname() );

            $child = Mage::getModel("customer/customer")->load($customer->getId());
            Zend_Debug::dump( $child->debug() );
        }
    }

    public function sqlExampleAction(){
        $stores = Mage::getModel("core/store")->getCollection();
        $stores->addFieldToFilter("code", array("like"=>"en_"));
        echo "Our collection has ". count($stores) ." item(s)";

        /****************************************/
        // LIKE
        // $stores->addFieldToFilter("code", array("like"=>"en_"));
        // NOT LIKE
        // $stores->addFieldToFilter("code", array("nlike"=>"en_"));
        // and other detail
        // https://youtu.be/-HISDx0T7tc?t=5740
        /**************************************/

        //Zend_Debug::dump( $this->getChildrenCategories(Mage::getModel("catalog/category")) );
        //Zend_Debug::dump( Mage::getModel("catalog/category") );
    }

    /**
     * Retrieve a collection of child categories for the provided category
     *
     * @param Mage_Catalog_Model_Category $category
     * @return Varien_Data_Collection_Db
     */
    protected function getChildrenCategoriesAction(Mage_Catalog_Model_Category $category)
    {
        $collection = $category->getCollection();
        $collection->addAttributeToSelect('url_key')
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('is_anchor')
            ->addAttributeToFilter('is_active', 1)
            ->addIdFilter($category->getChildren())
            ->setOrder('position', Varien_Db_Select::SQL_ASC)
            ->load();

        return $collection;
    }

    /**
     * get product info
     */
    public function getProductInfoAction(){
        $product = Mage::getModel('catalog/product')->load(3);
        //Zend_Debug::dump($product);

        echo $product->getData("description");
        echo "<br/>";
        //$product->setDescription("TEST");
        //$product->save(); // apply!!! update

        //echo "<br/>";
        echo $product->getDescription();

        // for UPDATE data
        //$product->setDescription("Фирменный стиль, в рамках сегодняшних воззрений...");
        //$product->save(); // apply!!! update

        // for delete
        // Mage::app('admin'); for alloy delete in frontend
        $product->delete();
    }
}