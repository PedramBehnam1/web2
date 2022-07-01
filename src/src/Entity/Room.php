<?php

namespace App\Entity;

use App\Interface\TimeInterface;
use App\Interface\UserInterface;
use App\Model\TimableTrait;
use App\Model\UserTrait;
use App\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room implements TimeInterface , UserInterface
{
    use TimableTrait;
    use UserTrait;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer'), Assert\Range([
        'min' => 1,
        'notInRangeMessage' => 'You must be greater than {{ min }} .',
    ])]
    private $roomNumber;

    #[ORM\Column(type: 'integer'), Assert\Range([
        'min' => 1,
        'max' => 15,
        'notInRangeMessage' => 'You must be between {{ min }} and {{ max }} .',
    ])]
    private $numberOfBeds;

    #[ORM\Column(type: 'string', length: 255),  Assert\Choice([
        'choices' => ['Empty', 'Full'],
        'message' => 'write Empty or Full .',
    ])]
    private $situation;

    #[ORM\ManyToOne(targetEntity: Hotel::class, inversedBy: 'rooms')]
    #[ORM\JoinColumn(nullable: false)]
    private $hotel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoomNumber(): ?int
    {
        return $this->roomNumber;
    }

    public function setRoomNumber(int $roomNumber): self
    {
        $this->roomNumber = $roomNumber;

        return $this;
    }

    public function getNumberOfBeds(): ?int
    {
        return $this->numberOfBeds;
    }

    public function setNumberOfBeds(int $numberOfBeds): self
    {
        $this->numberOfBeds = $numberOfBeds;

        return $this;
    }

    public function getSituation(): ?string
    {
        return $this->situation;
    }

    public function setSituation(string $situation): self
    {
        $this->situation = $situation;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }
}
