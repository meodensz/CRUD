<?php

namespace Sparsh\CRUD\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface PostRepositoryInterface
{
    public function save(\Sparsh\CRUD\Api\Data\PostInterface $Post);

    public function getById($PostId);
    
    public function delete(\Sparsh\CRUD\Api\Data\PostInterface $Post);

    public function deleteById($PostId);
}