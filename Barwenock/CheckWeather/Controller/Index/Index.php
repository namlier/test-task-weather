<?php

namespace Barwenock\CheckWeather\Controller\Index;

use Magento\Framework\App\Action\Action;

/**
 * Index Controller.
 */
class Index extends Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    ) {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        return $this->_pageFactory->create();
    }
}
