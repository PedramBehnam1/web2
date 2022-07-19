<?php

namespace App\Security;

// use App\Interface\OwnedInterface;

use App\Entity\Hotel;
use App\Entity\User;
use App\Interface\OwnerInterface;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Psr\Log\LoggerInterface;
use SebastianBergmann\Environment\Console;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

use function PHPUnit\Framework\isEmpty;

class OwnerVoter extends Voter
{

 const VIEW = 'view';
 const NEW = 'new';
 const EDIT = 'edit';
 const Delete = 'delete'; 

protected function supports(string $attribute, $subject):bool
 {
  if (!in_array($attribute, [self::VIEW, self::EDIT, self::Delete, self::NEW])) {
    return false;
  }

// only vote on `Post` objects
  if (!$subject instanceof Hotel) {
    return false;
  }

  return true;
 }

 /**
  * @param string $attribute
  * @param OwnerInterface $subject
  * @param TokenInterface $token
  * @return bool
 */
 protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token):bool
 {
  $user = $token->getUser(); 
  if (!$user instanceof User) {
    return false;
  } 

  /** @var Hotel $hotel  */
  $hotel = $subject;

  switch ($attribute) {
    case self::VIEW:
        return $this->canView();//nabayad configi kard - config nemikhad - shayad subject to hotel tashkis nemide
    case self::EDIT:
        return $this->canEdit($hotel, $user); // alan vared in mishe 
    case self::NEW:
        return $this->canNew($subject, $user); // ajibe kar nemikone - mesle mane -bear edit esh ham test konam
    case self::Delete:
        return $this->canDelete($hotel, $user); // hala kamel kon
    }
 }


/**
  * @return bool
 */
 public function canView(){ // view ro hame mitonna bebiann - pas retur n mikoni true
    return true;
 }
/**
  * @param Hotel $hotel
  * @param OwnerInterface $subject
  * @return bool
 */
 public function canEdit($hotel, $user){  // be in gir mide
  return ($hotel->getEditor() === $user || $hotel->getHotelOwner() === $user);
 } 

/**
  * @param OwnerInterface $subject
  * @param User $user
  * @return bool
 */
  public function canNew($hotel, $user){ 
  return !$user->getHotels()->isEmpty();
  } 

  /**
  * @param Hotel $hotel
  * @param OwnerInterface $subject
  * @return bool
 */
 public function canDelete($hotel, $user){ 
  return ($hotel->getEditor() == $user || $hotel->getHotelOwner() == $user);
 } 
}



