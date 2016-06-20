<?php

/**
 * Created by Alexandr Krivonos
 * Email: krausweb291985@gmail.com
 * Date: 3/25/16
 * Time: 5:06 PM
 *
 * для работы Observer-event событий может класс
 * app/code/core/Mage/Core/Controller/Varien/Front.php
 * и его разные "методы" init()/dispatch, и события в них например:
 * controller_front_init_before
 * controller_front_init_routers
 * controller_front_send_response_before
 * controller_front_send_response_after
 *
 * All events https://magento2.atlassian.net/wiki/display/m1wiki/Magento+1.x+Events+Reference
 *
 * @var $observer \Varien_Event_Observer /lib/Varien/Event/Observer.php
 */
class AKS_Training_Model_Observer
{
    /**
     * Карточка товара - добавляем к имени доп информацию
     *
     * @param Varien_Event_Observer $observer
     */
    public function CatalogProductLoadAfter(Varien_Event_Observer $observer){
        // http://site.com.local/category/product.html

        $product = $observer->getProduct();
        $product->setName($product->getName() . " - SALE!");
    }


    /**
     * Вытаскиваем Ник пользователя и пишем в лог файл
     *
     * @param Varien_Event_Observer $observer
     */
    public function controllerActionPredispatch(Varien_Event_Observer $observer){
        // http://site.com.local/admin

        //$permission = Mage::getSingleton("admin/session")->isAllowed($observer);
        //Zend_Debug::dump($permission);

        try{
            $user = Mage::getSingleton("admin/session")->getUser();
            // сама запись в лог файл admin.log
            Mage::log((($user) ? $user->getUsername() : " Not Logged in") . " " .
                      Mage::app()->getRequest()->getPathInfo(), Zend_Log::INFO, 'admin.log', true);
        }catch (Exception $e){
            // лог Exception по умолчанию (/var/log/exception.log)
            Mage::logException( $e );

            // дополнительных лог записей ошибок моего модуля (/var/log/aks.log)
            Mage::log("Don't work AKS_Training_Model_Observer:controllerActionPredispatch()\n" . $e->getMessage()
                , Zend_Log::ERR, 'aks.log', true);
        }
    }

    /**
     * Тестовые записи события в лог-файл при запуске по cron (app/code/local/AKS/Training/etc/config.xml)
     */
    public function runImportTest(){
        // сама запись в лог файл admin.log
        Mage::log("Тестовая запись в лог-файл через crontab в app/code/local/AKS/Training/etc/config.xml ",
                  Zend_Log::INFO, 'crontab_training.log', true);
    }

    /**
     * Когда в url присутствует "/home" - переадресовать на главную
     *
     * @param Varien_Event_Observer $observer
     */
    public function controllerActionPredispathcCmsPageView(Varien_Event_Observer $observer){
        $action = $observer->getControllerAction();
        $path_info = $action->getRequest()->getPathInfo();
        if(mb_strstr($path_info, '/home') !== false){
            $action->getResponse()->setRedirect(Mage::getBaseUrl());
            $action->getRequest()->setDispatched(true);
        }
    }

    /**
     * Если в старой версии Magento включен некий параметр (payment/ccsave/active) -
     *      - переопределить вызов на свой класс (AKS_Training_Helper_Payment)
     *
     * @param Varien_Event_Observer $observer
     */
    public function controllerFrontInitBefore(Varien_Event_Observer $observer){
        if(version_compare(Mage::getVersion(), '1.4.0', '<')){
            if(Mage::getStoreConfigFlag('payment/ccsave/active')){
                Mage::getConfig()->getNode('global/helpers/payment/rewrite/data', 'AKS_Training_Helper_Payment');
            }
        }
    }
}