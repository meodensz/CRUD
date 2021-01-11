<?php

namespace Sparsh\CRUD\Controller\Index;
 
use Magento\Framework\App\Filesystem\DirectoryList;
 
class Save extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    protected $_postFactory;

    protected $_coreRegistry;

    protected $resultRedirect;

    protected $urlInterface;

    private $_cacheTypeList;
    
    private $_cacheFrontendPool;
 
     public function __construct(
            \Magento\Framework\App\Action\Context $context,
	        \Magento\Framework\View\Result\PageFactory $pageFactory,
	        \Sparsh\CRUD\Model\PostFactory $postFactory,
	        \Magento\Framework\Registry $coreRegistry,
	        \Magento\Framework\Controller\ResultFactory $result,
	        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
	        \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool
          )
     {
        $this->_pageFactory = $pageFactory;
        $this->_postFactory = $postFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->resultRedirect = $result;
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheFrontendPool = $cacheFrontendPool;

          return parent::__construct($context);
     }
 
     public function execute()
     {
          if ($this->getRequest()->isPost()) {
               $input = $this->getRequest()->getPostValue();
               $post = $this->_postFactory->create();
 
          if(isset($_POST['btne'])){
                    $post->setId($_POST['btne']);
		            $post->setData('name',$_POST['name']);
                    $post->save();
          }elseif (isset($_POST['btnc'])) {

            $post->setData('name',$_POST['name']);
            $post->save();
        }
         $types = ['config','layout','block_html','collections','reflection','db_ddl','compiled_config','eav','config_integration','config_integration_api','full_page','translate','config_webservice','vertex'];
        foreach ($types as $type) {
            $this->_cacheTypeList->cleanType($type);
        }
        foreach ($this->_cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }
 
              return $this->_redirect('crud/index/index');
          }
     }
}