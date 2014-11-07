<?php

class Ianitsky_RootCategory_Model_Store_Group extends Mage_Core_Model_Store_Group
{
	public function getRootCategoryId()
	{
		if (Mage::getStoreConfig('design/categories/root_category'))
		{
			return Mage::getStoreConfig('design/categories/root_category');
		}

		return $this->_getData('root_category_id');
	}
}
