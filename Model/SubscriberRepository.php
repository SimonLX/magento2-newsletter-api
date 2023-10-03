<?php

namespace Silex\NewsletterApi\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Newsletter\Model\SubscriberFactory;
use Magento\Newsletter\Model\ResourceModel\Subscriber as ResourceModel;
use Silex\NewsletterApi\Api\SubscriberRepositoryInterface;

/**
 * Class SubscriberRepository
 *
 * Repository class for newsletter subscriber
 */
class SubscriberRepository implements SubscriberRepositoryInterface
{
    protected ResourceModel $resource;
    protected SubscriberFactory $subscriberFactory;

    /**
     * SubscriberRepository constructor
     *
     * @param ResourceModel     $resource
     * @param SubscriberFactory $subscriberFactory
     */
    public function __construct(ResourceModel $resource, SubscriberFactory $subscriberFactory)
    {
        $this->resource = $resource;
        $this->subscriberFactory = $subscriberFactory;
    }

    /**
     * @inheritDoc
     */
    public function getById($subscriberId)
    {
        $subscriber = $this->subscriberFactory->create();
        $this->resource->load($subscriber, $subscriberId);
        if (!$subscriber->getId()) {
            throw new NoSuchEntityException(__('The newsletter subscriber #%1 doesn\'t exist.', $subscriberId));
        }

        return $subscriber;
    }
}
