<?php

namespace Silex\NewsletterApi\Api;

/**
 * Interface SubscriberRepositoryInterface
 */
interface SubscriberRepositoryInterface
{
    /**
     * Retrieve newsletter subscriber by ID.
     *
     * @param int $subscriberId
     *
     * @return \Magento\Newsletter\Model\Subscriber
     *
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($subscriberId);

    /**
     * Retrieve newsletter subscribers matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \Silex\NewsletterApi\Api\Data\SubscriberSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}
