<?php

namespace App\Services;

use App\Entity\Hotel;
use Doctrine\ORM\EntityManagerInterface;

class SearchHotel
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function search($input)
    {
        $input = str_replace("%", "[%]", $input);

        $hotelRepository = $this->entityManager->getRepository(Hotel::class);
        return $hotelRepository->createQueryBuilder('b')
            ->where('b.name like :q')
            ->setParameter('q', '%' . $input . '%')
            ->getQuery()
            ->getResult();
    }
}