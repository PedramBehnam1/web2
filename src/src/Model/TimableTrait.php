<?php


namespace App\Model;

use Doctrine\ORM\Mapping as ORM; // khob ina ke okeye- are nemidonam chera

trait TimableTrait
{


 #[ORM\Column(type: 'datetime_immutable', nullable: true)]
 private $createdAt;

 #[ORM\Column(type: 'datetime_immutable', nullable: true)]
 private $updatedAt;

 /**
  * @return mixed
  */
 public function getCreatedAt()
 {
   return $this->createdAt;
 }

 /**
  * @param mixed $createdAt
  */
 public function setCreatedAt($createdAt): void
 {
  $this->createdAt = $createdAt;
 }

 /**
  * @return mixed
  */
 public function getUpdatedAt()
 {
  return $this->updatedAt;
 }

 /**
  * @param mixed $updatedAt
  */
 public function setUpdatedAt($updatedAt): void
 {
  $this->updatedAt = $updatedAt;
 }

}