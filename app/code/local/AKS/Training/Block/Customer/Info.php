<?php

/**
 * Description
 *
 * @category    Local
 * @package     AKS_Training
 * @author      Alexandr Krivonos <krausweb291985@gmail.com>
 * @copyright   3/27/16 9:32 PM AKS
 *
 * @var         $this
 * @file        app/code/local/AKS/Training/Block/Customer/Info.php
 */
class AKS_Training_Block_Customer_Info extends Mage_Core_Block_Template
{
    public function getName(){
        return mt_rand();
    }

    public function getTrainingData(){
        // Вытянуть имя пользователя. $this->escapeHtml() - как хорорший тон, дополнительно
        $customers = trim( $this->escapeHtml( Mage::getSingleton("customer/session")->getCustomer()->getName()) );
        //Zend_Debug::dump($customers);

        // или
        //$customers = trim( $this->escapeHtml( Mage::helper('customer')->getCustomerName()) );
        //Zend_Debug::dump($customers);

        // узнать текущий handles
        // Zend_Debug::dump($this->getLayout()->getUpdate()->getHandles());


        // customer_logged_in - Handle - для ЗАЛОГинен
        // customer_logged_out - НЕ ЗАЛогинен


        return ($customers) ? $customers :  " Not Logged in";
    }
}