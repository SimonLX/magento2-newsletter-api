<?php
/*******************************************************************************
 * Created by HOMEMADE.IO SAS.
 * Splio Sync  -  Connect Splio with your Magento
 *
 * Copyright (C) HOMEMADE.IO SAS, Inc - All Rights Reserved
 *
 * @author    Simon Laubet-Xavier <simon.laubetxavier@home-made.io>
 * @copyright 2022-2023 HOMEMADE.IO SAS
 * @date      2023-09-27
 ******************************************************************************/

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
}
