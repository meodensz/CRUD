<?php

namespace Sparsh\CRUD\Model;

use Sparsh\CRUD\Api\Data;
use Sparsh\CRUD\Api\PostRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Sparsh\CRUD\Model\ResourceModel\Post as ResourcePost;
use Sparsh\CRUD\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;


class PostRepository implements PostRepositoryInterface
{
    protected $resource;

    protected $PostFactory;
    
    protected $PostCollectionFactory;

    protected $searchResultsFactory;

    private $collectionProcessor;

    public function __construct(
        ResourcePost $resource,
        PostFactory $PostFactory,
        Data\PostInterfaceFactory $dataPostFactory,
        PostCollectionFactory $PostCollectionFactory
    )
    {
        $this->resource = $resource;
        $this->PostFactory = $PostFactory;
        $this->PostCollectionFactory = $PostCollectionFactory;
    }

    public function save(\Sparsh\CRUD\Api\Data\PostInterface $Post)
    {
        try {
            $this->resource->save($Post);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the Post: %1', $exception->getMessage()),
                $exception
            );
        }
        return $Post;
    }

    public function getById($PostId)
    {
        $Post = $this->PostFactory->create();
        $Post->load($PostId);
        if (!$Post->getId()) {
            throw new NoSuchEntityException(__('The CMS Post with the "%1" ID doesn\'t exist.', $PostId));
        }
        return $Post;
    }

    public function getList()
    {
        $collection = $this->PostCollectionFactory->create();
        return $collection;
    }

    public function delete(\Sparsh\CRUD\Api\Data\PostInterface $Post)
    {
        try {
            $this->resource->delete($Post);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Post: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    public function deleteById($PostId)
    {
        return $this->delete($this->getById($PostId));
    }

}