<?php

namespace App\Controller;

use App\Entity\Location;
use App\Form\LocationType;
use App\Repository\LocationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

#[Route('/location')]
class LocationController extends AbstractController
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

    #[Route('/', name: 'app_location_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $locations = $entityManager
            ->getRepository(Location::class)
            ->findAll();

        return $this->render('location/index.html.twig', [
            'locations' => $locations,
        ]);
    }

    #[Route('/new', name: 'app_location_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $location = new Location();
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);
        // $location->setCreatedAt(new \DateTimeImmutable('now'));
        

        // $token = $this->tokenStorage->getToken();
        // if ($token instanceof TokenInterface) {
        //     /** @var User $user */
        //     $user = $token->getUser()->getUserIdentifier();
        //     $location->setCreatedUsername($user);
        // }
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($location);
            $entityManager->flush();

            return $this->redirectToRoute('app_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('location/new.html.twig', [
            'location' => $location,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_location_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Location $location): Response
    {
        return $this->render('location/show.html.twig', [
            'location' => $location,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_location_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Location $location, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);
        // $location->setUpdatedAt(new \DateTimeImmutable('now'));

        // $token = $this->tokenStorage->getToken();
        // if ($token instanceof TokenInterface) {
        //     /** @var User $user */
        //     $user = $token->getUser()->getUserIdentifier();
        //     $location->setUpdatedUsername($user);
        // }

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_location_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('location/edit.html.twig', [
            'location' => $location,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_location_delete',requirements: ['id' => '\d+'], methods: ['POST'])]
    public function delete(Request $request, Location $location, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$location->getId(), $request->request->get('_token'))) {
            $entityManager->remove($location);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_location_index', [], Response::HTTP_SEE_OTHER);
    }
}
