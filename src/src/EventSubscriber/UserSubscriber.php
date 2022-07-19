<?php

namespace App\EventSubscriber;

use App\Interface\UserInterface as InterfaceUserInterface;
use App\Model\UserInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class UserSubscriber implements EventSubscriber
{

 /** @var  TokenStorageInterface */
 private $tokenStorage;

 /**
  * @param TokenStorageInterface  $storage
  */
 public function __construct(
     TokenStorageInterface $storage,
 )
 {
     $this->tokenStorage = $storage;
 }


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

  if ($entity instanceof InterfaceUserInterface) {
   $token = $this->tokenStorage->getToken();
   if ($token instanceof TokenInterface) {
    /** @var User $user */
    $user = $token->getUser()->getUserIdentifier();
    
    $entity->setCreatedUsername($user);
    $entity->setUpdatedUsername($user);
    
   }
  }
 }

 public function preUpdate(LifecycleEventArgs $args)
 {
  $entity = $args->getObject();

  if ($entity instanceof InterfaceUserInterface) {
   $token = $this->tokenStorage->getToken();
   if ($token instanceof TokenInterface) {
    /** @var User $user */
    $user = $token->getUser()->getUserIdentifier();
    $entity->setUpdatedUsername($user);
   }
  }
 }
}
