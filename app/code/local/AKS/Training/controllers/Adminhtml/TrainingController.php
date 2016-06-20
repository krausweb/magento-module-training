<?php
/**
 * Description Adminhtml controller
 *
 * @category    Local
 * @package     AKS_Training
 * @author      Alexandr Krivonos <krausweb291985@gmail.com>
 * @copyright   3/29/16 9:32 PM AKS
 *
 * @file        app/code/local/AKS/Training/controllers/Adminhtml/TrainingController.php
 */

class AKS_Training_Adminhtml_TrainingController extends Mage_Adminhtml_Controller_Action
{

    /** если нужно переписать права доступа, мол разде открыт всем или никому */
    /*protected function _isAllowed(){
        return Mage::getSingleton('admin/session')->isAllowed('admin');
    }*/

    // public function gridAction(){}

    /**
     * точка входа на страницу
     */
    public function indexAction(){
        // for default render page
        $this->loadLayout()->_setActiveMenu('aks_training');

        $this->_addContent( $this->getLayout()->createBlock('aks_training/adminhtml_training') );

        $this->renderLayout();
    }

    /**
     * добавление нового элемента
     * newAction/new/ - editAction/edit/ - saveAction/save/ - deleteAction/delete/ --- "зарезервированные" названия
     */
    public function newAction(){
        // переадресация на редактирование, потому-что всё заполнение идентично
        $this->_forward('edit');
    }

    /**
     * редактирование элемента
     */
    public function editAction(){
        // выбираем нужный элемент для редакции
        $id = (int)$this->getRequest()->getParam('entity_id');
        Mage::register('current_training', Mage::getModel('aks_training/training')->load($id));

        // подгрузка стандартного шаблона вывода информации
        $this->loadLayout()->_setActiveMenu('training');

        $this->_addContent( $this->getLayout()->createBlock('aks_training/adminhtml_training_edit') );
        $this->renderLayout();
    }

    /**
     * метод самого сохранения элемента
     */
    public function saveAction(){
        // ловим данные которые пришли с Edit.php ( AKS_Training_Block_Adminhtml_Training_Edit )
        if($data = $this->getRequest()->getPost()){
            try {
                $model = Mage::getModel('aks_training/training');
                $model->setData($data)->setEntityId($this->getRequest()->getParam('entity_id'));
                if(!$model->getEntityDate()){
                    $model->setEntityDate(time()); // if db.field_name in the UNIXTIME()
                }else{
                    $model->setEntityDate(strtotime($model->getEntityDate()));
                }
                // само сохранение
                $model->save();

                /* если требуется обработка фото
                $id = $model->getAircalculator_id();

                if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                    $uploader = new Varien_File_Uploader('image');
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg'));
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);
                    $uploader->save($helper->getImagePath(), $id . '.jpg'); // Upload the image
                } else {
                    if (isset($data['image']['delete']) && $data['image']['delete'] == 1) {
                        @unlink($helper->getImagePath($id));
                    }
                }
                */

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Data successfully added or updated'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'entity_id' => $this->getRequest()->getParam('entity_id')
                ));
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__("Element not found"));
        $this->_redirect("*/*/");
    }

    /**
     * метод самого удаления элемента
     */
    public function deleteAction(){
        if($id = $this->getRequest()->getParam("entity_id")){
            try{
                // само удаление
                Mage::getModel("aks_training/training")->setId($id)->delete();
                Mage::getSingleton("adminhtml/session")->addSuccess($this->__("The item was successfully created"));
            }catch(Exception $e){
                Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                $this->_redirect("*/*/edit", array('entity_id'=>$id));
            }
        }
        $this->_redirect("*/*/");
    }


    /**
     * массовое удаление элемента/тов
     */
    public function massDeleteAction(){
        $training = $this->getRequest()->getParam("training", null);

        if(is_array($training) && sizeof($training)>0){
            try{
                foreach($training as $id){
                    // само удаление
                    Mage::getModel("aks_training/training")->setId($id)->delete();
                }
                // текст в случае УСПЕХА. (вывод - в месте всех уведомлений - в левом верхнем углу)
                $this->_getSession()->addSuccess($this->__("All delete %d items", sizeof($training)));
            }catch (Exception $e){
                $this->_getSession()->addError($e->getMessage());
            }
        }else{
            // текст в случае ОШИБКИ(уведомление)
            $this->_getSession()->addError($this->__("Please, select the items"));
        }
        $this->_redirect("*/*");
    }
}