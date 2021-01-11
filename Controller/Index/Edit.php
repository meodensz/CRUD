<?php
namespace Sparsh\CRUD\Controller\Index;

use Magento\Framework\App\Action\Action;

class Edit extends Action
{
    protected $_pageFactory;

    protected $_postFactory;

    protected $_coreRegistry;

    protected $_postRepository;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Sparsh\CRUD\Model\PostFactory $postFactory,
        \Sparsh\CRUD\Model\PostRepository $postRepository,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_postFactory = $postFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->_postRepository = $postRepository;

        return parent::__construct($context);
    }

    public function execute()
    {
        $post_id = $this->getRequest()->getParam('post_id');
        $this->_coreRegistry->register('post_id', $post_id);
        return $this->_pageFactory->create();
    }
}