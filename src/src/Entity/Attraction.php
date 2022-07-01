<?php

namespace App\Entity;

use App\Model\TimableTrait;
use App\Interface\TimeInterface;
use App\Interface\UserInterface;
use App\Model\UserTrait;
use App\Repository\AttractionRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AttractionRepository::class)]
// #[ORM\InheritanceType("MappedSuperclass")]
#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorColumn(name:"type", type:"string")]
#[ORM\DiscriminatorMap(["attraction" => "Attraction", "location" => "Location", "event" => "Event"])]

class Attraction implements  TimeInterface , UserInterface
{

    use TimableTrait;   
    use UserTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string', length: 255)]
    protected $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected $shortDescription;

    #[ORM\Column(type: 'string', length: 255)]
    protected $fullDescription;

    #[ORM\Column(type: 'integer'), Assert\Range([
        'min' => 1,
        'max' => 10,
        'notInRangeMessage' => 'You must be between {{ min }} and {{ max }} .',
    ])]
    protected $score ;

    public function __construct($name , $shortDescription , $fullDescription , $score)
    {
        $this->name = $name;
        $this->shortDescription = $shortDescription;
        $this->fullDescription = $fullDescription;
        $this->score = $score;
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

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getFullDescription(): ?string
    {
        return $this->fullDescription;
    }

    public function setFullDescription(string $fullDescription): self
    {
        $this->fullDescription = $fullDescription;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;

        return $this;
    }

    
}
