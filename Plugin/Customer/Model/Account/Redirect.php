<?php

namespace Genesisoft\RedirectCustomer\Plugin\Customer\Model\Account;

use Magento\Framework\Controller\ResultFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\UrlInterface;
use Magento\Checkout\Model\CartFactory;

class Redirect
{
    protected $coreRegistry;

    protected $url;

    protected $resultFactory;

    public function __construct(Session $customerSession, UrlInterface $url, ResultFactory $resultFactory, CartFactory $cart) {
        $this->customerSession = $customerSession;
        $this->url = $url;
        $this->resultFactory = $resultFactory;
        $this->cart = $cart;
    }

    /**
     * Redireciona o cliente para o Checkout quando há produto no carrinho
     * @param $subject
     * @param \Closure $proceed
     * @return \Magento\Framework\Controller\Result\Redirect|mixed
     */
    public function aroundGetRedirect($subject, \Closure $proceed) {
        if ($this->customerSession->getData('is_new_account')) {
            if ($this->cart->create()->getItemsCount() > 0) {
                /** @var \Magento\Framework\Controller\Result\Redirect $result */
                $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                $result->setUrl($this->url->getUrl('checkout'));
                return $result;
            }
        }
        return $proceed();
    }
}
