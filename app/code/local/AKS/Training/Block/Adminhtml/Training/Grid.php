<?php

/**
 * Description Adminhtml Block Grid
 *
 * @category    Local
 * @package     AKS_Training
 * @author      Alexandr Krivonos <krausweb291985@gmail.com>
 * @copyright   3/29/16 9:32 PM AKS
 *
 * @file        app/code/local/AKS/Training/Block/Adminhtml/Training/Grid.php
 */

class AKS_Training_Block_Adminhtml_Training_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    // protected function _construct(){}

    // public function getGridUrl(){}

    /**
     * Prepare Grid Columns
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('aks_training/training')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $helper = Mage::helper('aks_training');

        $this->addColumn('entity_id', array(
            'header' => $helper->__('ID'),
            'index' => 'entity_id'
        ));

        $this->addColumn('entity_name', array(
            'header' => $helper->__('Name'),
            'index' => 'entity_name',
            'type' => 'text',
        ));

        // @todo
        $this->addColumn('entity_is_active', array(
            'header' => $helper->__('Active'),
            'index' => 'entity_is_active',
            'type' => 'checkbox',
        ));

        return parent::_prepareColumns();
    }

    /**
     * for delete
     * работает в сумме с
     * app/code/local/RM/DummyModule/controllers/Adminhtml/DummymoduleController.php::massDeleteAction()
     *
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('training');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => $this->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
        ));
        return $this;
    }

    public function getRowUrl($model)
    {
        return $this->getUrl('*/*/edit', array(
            'entity_id' => $model->getEntityId(),
        ));
    }
}