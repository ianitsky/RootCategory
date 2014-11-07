<?php

class Ianitsky_RootCategory_Model_System_Config_Source_Category_SubCategory
{
    public function toOptionArray($addEmpty = true, $level = 2)
    {
        $collection = Mage::getResourceModel('catalog/category_collection');

        $collection->addAttributeToSelect('name')
			->addLevelFilter($level)
            ->load();

        $options = array();

        if ($addEmpty) {
            $options[] = array(
                'label' => Mage::helper('adminhtml')->__('-- Please Select a Category --'),
                'value' => ''
            );
        }

		//Get default root category to default store
		$store =  Mage::getModel('core/store')->load(Mage::getSingleton('adminhtml/config_data')->getStore())->getGroup();
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
