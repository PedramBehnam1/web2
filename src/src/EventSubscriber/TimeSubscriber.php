<?php

namespace App\EventSubscriber;

use App\Interface\TimeInterface as InterfaceTimeInterface;
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

        if ($entity instanceof InterfaceTimeInterface) {
            $entity->setCreatedAt(new \DateTimeImmutable());
            $entity->setupdatedAt(new \DateTimeImmutable());
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof InterfaceTimeInterface) {
            $entity->setupdatedAt(new \DateTimeImmutable());
        }
    }
}
