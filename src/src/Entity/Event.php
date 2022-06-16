<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event extends Attraction
{
    

    #[ORM\Column(type: 'string', length: 255)]
    public $organizer;

    #[ORM\Column(type: 'datetime_immutable')]
    public $startDateTime;

    #[ORM\Column(type: 'datetime_immutable')]
    public $end_datetime;

    

    public function getOrganizer(): ?string
    {
        return $this->organizer;
    }

    public function setOrganizer(string $organizer): self
    {
        $this->organizer = $organizer;

        return $this;
    }

    public function getStartDateTime(): ?\DateTimeImmutable
    {
        return $this->startDateTime;
    }

    public function setStartDateTime(\DateTimeImmutable $startDateTime): self
    {
        $this->startDateTime = $startDateTime;

        return $this;
    }

    public function getEndDatetime(): ?\DateTimeImmutable
    {
        return $this->end_datetime;
    }

    public function setEndDatetime(\DateTimeImmutable $end_datetime): self
    {
        $this->end_datetime = $end_datetime;

        return $this;
    }
}
