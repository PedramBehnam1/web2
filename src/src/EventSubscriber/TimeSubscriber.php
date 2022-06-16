<?php

namespace App\EventSubscriber;

use App\Model\TimeInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class TimeSubscriber implements EventSubscriber
{
    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof TimeInterface) {
            $entity->setCreatedAt(new \DateTimeImmutable());
            $entity->setupdatedAt(new \DateTimeImmutable());
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof TimeInterface) {
            $entity->setupdatedAt(new \DateTimeImmutable());
        }
    }
}
