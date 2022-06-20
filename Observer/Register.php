<?php

namespace Genesisoft\RedirectCustomer\Observer;


use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Model\Session;

class Register implements ObserverInterface
{
    protected $customerSession;

    public function __construct(Session $customerSession)
    {
        $this->customerSession = $customerSession;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->customerSession->setData('is_new_account', true);
    }
}
