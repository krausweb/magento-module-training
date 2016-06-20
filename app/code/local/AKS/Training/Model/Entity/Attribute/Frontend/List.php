<?php
/**
 * Created by Alexandr Krivonos
 * Email: krausweb291985@gmail.com
 * Date: 3/24/16
 * Time: 9:21 PM
 */

class AKS_Training_Model_Entity_Attribute_Frontend_List extends Mage_Eav_Model_Entity_Attribute_Frontend_Abstract
{
    /**
     * Для "всех" Модулей в AKS и типов данных "multiselect"(selectbox в админке) - отображать данные li списком
     * @param Varien_Object $object
     * @return bool|mixed|string
     */
    public function getValue(Varien_Object $object){
        if($this->getConfigField('input') == 'multiselect'){
            $value = $object->getData($this->getAttribute()->getAttributeCode());
            $value = $this->getOption($value);

            if(is_array($value)){
                $output = "<ul><li>";
                $output .= implode("</li><li>", $value);
                $output .= "</li></ul>";
                return $output;
            }
            return $value;
        }else{
            return parent::getValue($object);
        }
    }
}