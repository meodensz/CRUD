<?php

namespace Sparsh\CRUD\Model\ResourceModel\Post;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'post_id';

	protected $_eventPrefix = 'aht_dell_post_collection';
	
	protected $_eventObject = 'post_collection';
        /**
         * Define resource model
         *
         * @return void
         */
        protected function _construct()
        {
                $this->_init('Sparsh\CRUD\Model\Post', 'Sparsh\CRUD\Model\ResourceModel\Post');
        }
}
