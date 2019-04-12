<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

namespace AppBundle\EventListener;

use Doctrine\ORM\Event\OnFlushEventArgs;
use AppBundle\Entity\Category;
use AppBundle\Entity\Section;
use AppBundle\Entity\Content;
use AppBundle\Service\ContentService;

class ContentListener
{
    /**
     * ContentService
     *
     * @var ContentService
     */
    private $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }
    
    /**
    * Intercept flush of any entity
    *
    * @param OnFlushEventArgs $args
    */
    public function onFlush(OnFlushEventArgs $args)
    {
        $em  = $args->getEntityManager();
        $uow = $em->getUnitOfWork();
        $eventManager = $em->getEventManager();
        $entities = array_merge(
            $uow->getScheduledEntityInsertions(),
            $uow->getScheduledEntityUpdates()
        );
        foreach ($entities as $entity) {
            if ($entity instanceof Category
            || $entity instanceof Section
            || $entity instanceof Content) {
                $eventManager->removeEventListener('onFlush', $this);
                if ($uow->getEntityChangeSet($entity)) {
                    $em->flush();
                    if ($this->contentService->setContentRoute($entity)) {
                        $em->persist($entity);
                        $metaData = $em->getClassMetadata(get_class($entity));
                        $uow->recomputeSingleEntityChangeSet($metaData, $entity);
                        $uow->computeChangeSets();
                    } else {
                        throw new Exception("Error Processing Request", 1);
                    }
                }
            }
        }
    }
}
