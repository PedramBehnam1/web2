<?php


namespace App\Model;

use Doctrine\ORM\Mapping as ORM; // khob ina ke okeye- are nemidonam chera

trait UserTrait
{


 #[ORM\Column(type: 'string', length: 255, nullable: true)]
 private $createdUsername;

 #[ORM\Column(type: 'string', length: 255, nullable: true)]
 private $updatedUsername;

 /**
  * @return mixed
  */
 public function getCreatedUsername()
 {
   return $this->createdUsername;
 }

 /**
  * @param mixed $createdAt
  */
 public function setCreatedUsername($createdUsername): void
 {
  $this->createdUsername = $createdUsername;
 }

 /**
  * @return mixed
  */
 public function getUpdatedUsername()
 {
  return $this->updatedUsername;
 }

 /**
  * @param mixed $updatedAt
  */
 public function setUpdatedUsername($updatedUsername): void
 {
  $this->updatedUsername = $updatedUsername;
 }

}