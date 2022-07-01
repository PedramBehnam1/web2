<?php

namespace App\Entity;

use App\Interface\TimeInterface;
use App\Interface\UserInterface;
use App\Model\TimableTrait;
use App\Model\TimeTrait;
use App\Model\UserTrait;
use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

#[ORM\Entity(repositoryClass: HotelRepository::class)]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false, hardDelete: true)]
class Hotel implements TimeInterface , UserInterface
{
    use TimableTrait;
    use UserTrait;
    use SoftDeleteableEntity; 

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255) , 
    Assert\Regex(pattern:"/^[a-zA-Z]+$/")]
    private $name;
    
    #[ORM\Column(type: 'text'), Assert\Regex(pattern:"/^[a-zA-Z|\s]+$/")]
    private $address;

    #[ORM\Column(type: 'string', length: 255, nullable: true), Assert\Regex(pattern:"/^[\d|\s]+$/")]
    private $phoneNumber;


    #[ORM\Column(type: 'string', length: 255, nullable: true), Assert\Email()]
    private $email;

    #[ORM\Column(type: 'integer'), Assert\Range([
        'min' => 1,
        'max' => 10,
        'notInRangeMessage' => 'You must be between {{ min }} and {{ max }} .',
    ])]
    private $score;

    

    #[ORM\OneToMany(mappedBy: 'hotel', targetEntity: Room::class, orphanRemoval: true)]
    private $rooms;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    

    /**
     * @return Collection<int, Room>
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
            $room->setHotel($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): self
    {
        if ($this->rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getHotel() === $this) {
                $room->setHotel(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

}
