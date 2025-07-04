<?php

namespace Silex\NewsletterApi\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface as CollectionProcessor;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Newsletter\Model\SubscriberFactory;
use Magento\Newsletter\Model\ResourceModel\Subscriber as ResourceModel;
use Magento\Newsletter\Model\ResourceModel\Subscriber\CollectionFactory;
use Silex\NewsletterApi\Api\SubscriberRepositoryInterface;
use Silex\NewsletterApi\Api\Data\SubscriberSearchResultsInterfaceFactory as SearchResultsFactory;

/**
 * Class SubscriberRepository
 *
 * Repository class for newsletter subscriber
 *
 * phpcs:disable Magento2.Commenting.ClassPropertyPHPDocFormatting.Missing
 */
class SubscriberRepository implements SubscriberRepositoryInterface
{
    private ResourceModel $resource;
    private SubscriberFactory $subscriberFactory;
    private CollectionFactory $collectionFactory;
    private SearchResultsFactory $searchResultsFactory;

    /** @var CollectionProcessor $collectionProcessor */
    private $collectionProcessor;

    /**
     * SubscriberRepository constructor
     *
     * @param ResourceModel            $resource
     * @param SubscriberFactory        $subscriberFactory
     * @param CollectionFactory        $collectionFactory
     * @param SearchResultsFactory     $searchResultsFactory
     * @param CollectionProcessor|null $collectionProcessor
     */
    public function __construct(
        ResourceModel        $resource,
        SubscriberFactory    $subscriberFactory,
        CollectionFactory    $collectionFactory,
        SearchResultsFactory $searchResultsFactory,
        ?CollectionProcessor $collectionProcessor = null
    ) {
        $this->resource = $resource;
        $this->subscriberFactory = $subscriberFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor
            ?: ObjectManager::getInstance()->get(CollectionProcessor::class);
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

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
