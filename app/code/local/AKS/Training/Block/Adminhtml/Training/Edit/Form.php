<?php

/**
 * Description Adminhtml Block Grid/Form Form Data
 *
 * @category    Local
 * @package     AKS_Training
 * @author      Alexandr Krivonos <krausweb291985@gmail.com>
 * @copyright   3/29/16 9:32 PM AKS
 *
 * @file        app/code/local/AKS/Training/Block/Adminhtml/Training/Edit/Form.php
 */

class AKS_Training_Block_Adminhtml_Training_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $helper = Mage::helper('aks_training');
        $model = Mage::registry('current_training');

        $form = new Varien_Data_Form(array(
                                         'id' => 'edit_form',
                                         'action' => $this->getUrl('*/*/save', array(
                                             'entity_id' => $this->getRequest()->getParam('entity_id')
                                         )),
                                         'method' => 'post',
                                         'enctype' => 'multipart/form-data'
                                     ));

        $this->setForm($form);

        $fieldset = $form->addFieldset('aks_training', array('legend' => $helper->__('Information')));

        $fieldset->addField('entity_name', 'text', array(
            'label' => $helper->__('Name'),
            'required' => true,
            'name' => 'entity_name',
        ));

        $dateFormatIso = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
        $fieldset->addField('entity_date', 'date', array(
            'required' => false,
            'name' => 'entity_date',
            'label' => $helper->__('Date'),
            'title' => $helper->__('Date'),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'input_format' => $dateFormatIso,
            'format' => $dateFormatIso,
            'time' => true
        ));

        $fieldset->addField('entity_is_active', 'checkbox', array(
            'label' => $helper->__('Active'),
            'required' => false,
            'name' => 'entity_is_active',
        ));

        $form->setUseContainer(true);

        if($data = Mage::getSingleton('adminhtml/session')->getFormData()){
            $form->setValues($data);
        } else {
            $form->setValues($model->getData());
        }

        return parent::_prepareForm();
    }
}