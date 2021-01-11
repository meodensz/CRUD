<?php

namespace Sparsh\CRUD\Model;

use Sparsh\CRUD\Api\Data\PostInterface;
use \Magento\Framework\Model\AbstractModel;
use \Magento\Framework\DataObject\IdentityInterface;
 
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface,\Sparsh\CRUD\Api\Data\PostInterface
{
	const CACHE_TAG='sparsh_crud_post';

	protected $_cacheTag = 'sparsh_crud_post';

	protected $_eventPrefix = 'sparsh_crud_post';

        protected function _construct()
        {
                $this->_init('Sparsh\CRUD\Model\ResourceModel\Post');
        }
 
        public function getIdentities()
        {
                return [self::CACHE_TAG . '_' . $this->getId()];
        }
 
        public function getDefaultValues()
        {
                $values = [];
 
                return $values;
        }
}
