<?php

declare(strict_types=1);

/**
* Digit Software Solutions.
*
* NOTICE OF LICENSE
*
* This source file is subject to the EULA
* that is bundled with this package in the file LICENSE.txt.
*
* @category  Dss
* @package   Dss_MicrosoftClarity
* @author    Extension Team
* @copyright Copyright (c) 2024 Digit Software Solutions. ( https://digitsoftsol.com )
*/

namespace Dss\MicrosoftClarity\Block;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Customer\Model\ResourceModel\GroupRepository as CustomerGroupRepository;

class Script extends Template
{
    /**
     * Feature enabled config path
     */
    public const XML_MICROSOFT_CLARITY_GENERAL_ENABLE = 'microsoftclarity/general/enable';

    /**
     * Customer group
     */
    public const MICROSOFT_CLARITY_CUSTOMER_GROUP_TAG_ENABLE = 'microsoftclarity/general/customer_group_tag_enable';

    /**
     * Tracking code config path
     */
    public const XML_MICROSOFT_CLARITY_OPTIONS_TRACKING_CODE = 'microsoftclarity/options/tracking_code';

    /**
     * Script constructor.
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Customer\Model\ResourceModel\GroupRepository $customerGroupRepository
     * @param array $data
     */
    public function __construct(
        Context $context,
        protected ScopeConfigInterface $scopeConfig,
        protected CustomerSession $customerSession,
        protected CustomerGroupRepository $customerGroupRepository,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Returns the Clarity tracking code to be used in the javascript
     *
     * @return null|string
     */
    public function getClarityTrackingCode(): ?string
    {
        return $this->scopeConfig->getValue(
            self::XML_MICROSOFT_CLARITY_OPTIONS_TRACKING_CODE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Checks if feature is enabled
     *
     * @return bool|string
     */
    public function isEnabled(): bool|string
    {
        return $this->scopeConfig->getValue(
            self::XML_MICROSOFT_CLARITY_GENERAL_ENABLE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Checks if customer group tag to be added
     *
     * @return bool|string
     */
    public function isCustomerGroupTagEnabled(): bool|string
    {
        return $this->scopeConfig->getValue(
            self::MICROSOFT_CLARITY_CUSTOMER_GROUP_TAG_ENABLE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get Customer Groups
     *
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCustomerGroup(): string
    {
        $customerGroupId = $this->customerSession->getCustomerGroupId();
        $customerGroup = $this->customerGroupRepository->getById($customerGroupId);

        return $customerGroup->getCode();
    }
}
