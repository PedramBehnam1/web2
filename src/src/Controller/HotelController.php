<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Hotel;
use App\Entity\User;
use App\Form\HotelType;
use App\Repository\HotelRepository;
use App\Services\SearchHotel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface as TokenInterface;

#[Route('/hotel')]
class HotelController extends AbstractController
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
   

    #[Route('/{_locale}', name: 'app_hotel_index', methods: ['GET'], defaults:['_locale'=>'en'], requirements: ['_locale' => 'en|fa'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $hotels = $entityManager
            ->getRepository(Hotel::class)
            ->findAll();

        return $this->render('hotel/index.html.twig', [
            'hotels' => $hotels,
        ]);
    }

    #[Route('/new', name: 'app_hotel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $hotel = new Hotel();
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);
        $this->denyAccessUnlessGranted('new', $hotel);

        $token = $this->tokenStorage->getToken();
        if ($token instanceof TokenInterface) {
        /** @var User $user */
        $user = $token->getUser(); 
        $hotel->setHotelOwner($user);
        $hotel->setEditor($user);
        }
        // $createdAt = new \DateTimeImmutable('now');
        // $hotel->setCreateAt($createdAt); inja chikar konam 
         

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($hotel);
            $entityManager->flush();

            return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hotel/new.html.twig', [
            'hotel' => $hotel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hotel_show', methods: ['GET'] , requirements: ['id' => '\d+'])]
    public function show(Hotel $hotel): Response
    {

        $this->denyAccessUnlessGranted('view', $hotel);
        return $this->render('hotel/show.html.twig', [
            'hotel' => $hotel,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_hotel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Hotel $hotel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);
        $this->denyAccessUnlessGranted('edit', $hotel); 

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hotel/edit.html.twig', [
            'hotel' => $hotel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hotel_delete', methods: ['POST'] , requirements: ['id' => '\d+'])]
    #[IsGranted('ROLE_USER')]
    #[Security("is_granted('ROLE_USER')")]
    public function delete(Request $request, Hotel $hotel, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('delete', $hotel); 
        
        if ($this->isCsrfTokenValid('delete'.$hotel->getId(), $request->request->get('_token'))) {
            $entityManager->remove($hotel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/search', name: 'app_hotel_search', methods: ['GET'])]
    //#[ParamConverter('GET', class: 'SearchHotel:GET')]
    public function search(Request $request, SearchHotel $hotelSearch): Response
    {
        $q = $request->query->get('query');// in miad query to url ro migire - yani search moon - http://localhost/index.php/hotel/search?query=Azadi 
        $hotels = $hotelSearch->search($q);
        

        return $this->render('hotel/search.html.twig', [ 
            'query' => $q,
            'hotels' => $hotels,
        ]);
    }
}
