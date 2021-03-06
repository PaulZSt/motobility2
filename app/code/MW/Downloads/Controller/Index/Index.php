<?php
namespace MW\Downloads\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\Exception\NotFoundException;

class Index extends Action
{

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;
    protected $scopeConfig;

    public function __construct
    (
        Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        PageFactory $resultPageFactory
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    public function execute()
    {
        if(!$this->scopeConfig->getValue('downloads/general/enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE)){
            throw new NotFoundException(__('Parameter is incorrect.'));
        }
        $resultPage = $this->_resultPageFactory->create();

        // $metaTitleConfig = $this->scopeConfig->getValue('downloads/general/meta_title', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        // $metaKeywordsConfig = $this->scopeConfig->getValue('downloads/general/meta_keywords', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        // $metaDescriptionConfig = $this->scopeConfig->getValue('downloads/general/meta_description', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        // $pageTitle = $this->scopeConfig->getValue('downloads/general/page_title', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        $layoutConfig = $this->scopeConfig->getValue('downloads/general/layout', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if($layoutConfig == \MW\Downloads\Model\Source\Config\Layout::ONE_COLUMN){
            $resultPage->addHandle('downloads_1column_index');
        }
        else if($layoutConfig == \MW\Downloads\Model\Source\Config\Layout::TWO_COLUMN_RIGHT){
            $resultPage->addHandle('downloads_2right_index');
        }
        else if($layoutConfig == \MW\Downloads\Model\Source\Config\Layout::TWO_COLUMN_LEFT){
            $resultPage->addHandle('downloads_2left_index');
        }

        // $resultPage->getConfig()->getTitle()->set($metaTitleConfig);
        // $resultPage->getConfig()->setDescription($metaKeywordsConfig);
        // $resultPage->getConfig()->setKeywords($metaDescriptionConfig);

        // $pageMainTitle = $resultPage->getLayout()->getBlock('page.main.title');
        // if ($pageMainTitle && $pageMainTitle instanceof \Magento\Theme\Block\Html\Title) {
        //     $pageMainTitle->setPageTitle($pageTitle);
        // }

        return $resultPage;
    }
}