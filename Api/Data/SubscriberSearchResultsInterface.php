<?php
/*******************************************************************************
 * Created by HOMEMADE.IO SAS.
 * Splio Sync  -  Connect Splio with your Magento
 *
 * Copyright (C) HOMEMADE.IO SAS, Inc - All Rights Reserved
 *
 * @author    Simon Laubet-Xavier <simon.laubetxavier@home-made.io>
 * @copyright 2022-2022 HOMEMADE.IO SAS
 * @date      2022-10-28
 ******************************************************************************/

namespace Silex\NewsletterApi\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface SubscriberSearchResultsInterface
 */
interface SubscriberSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get subscribers list.
     *
     * @return \Magento\Newsletter\Model\Subscriber[]
     */
    public function getItems();

    /**
     * Set subscribers list.
     *
     * @param \Magento\Newsletter\Model\Subscriber[] $items
     *
     * @return \Silex\NewsletterApi\Api\Data\SubscriberSearchResultsInterface
     */
    public function setItems(array $items);
}
