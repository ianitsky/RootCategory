<?php

class Ianitsky_RootCategory_Model_System_Config_Source_Category_SubCategory
{
    public function toOptionArray($addEmpty = true, $level = 2)
    {
    	$store =  Mage::getModel('core/store')->load(Mage::getSingleton('adminhtml/config_data')->getStore())->getGroup();
    	
        $collection = Mage::getResourceModel('catalog/category_collection');
        $collection->addAttributeToSelect('name')
		->addLevelFilter($level)
		->addFieldToFilter('parent_id', array('eq'=>$store->getRootCategoryId()))
            	->load();

        $options = array();

        if ($addEmpty) {
            $options[] = array(
                'label' => Mage::helper('adminhtml')->__('-- Please Select a Category --'),
                'value' => ''
            );
        }

	//Get default root category to default store
	$category = Mage::getModel('catalog/category')->load($store->getRootCategoryId());
	$options[] = array(
		'label' => $category->getName(),
		'value' => $category->getId()
	);

        foreach ($collection as $category) {
			if($category->getData('level') == $level)
			{
				$options[] = array(
				   'label' => $category->getName(),
				   'value' => $category->getId()
				);
			}
        }

        return $options;
    }
}
