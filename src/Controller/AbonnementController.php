<?php

namespace App\Controller;

use App\Entity\Abonnement;
use App\Form\Abonnement1Type;
use App\Repository\AbonnementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/abonnement')]
class AbonnementController extends AbstractController
{
    #[Route('/', name: 'app_abonnement_index', methods: ['GET'])]
    public function index(Request $request, AbonnementRepository $abonnementRepository): Response
    {
        // $actif = false;
        $searchQuery = $request->query->get('recherche');
        // $queryBuilder = $abonnementRepository->getSearchQuery($searchQuery,$actif);
        $queryBuilder = $abonnementRepository->getSearchQuery($searchQuery);
        $abonnements = $queryBuilder->getResult();

        return $this->render('abonnement/index.html.twig', [
            'abonnements' => $abonnements,
        ]);
    }

    // #[Route('/corbeil', name: 'app_corbeil', methods: ['GET'])]
    // public function corbeil(Request $request, AbonnementRepository $abonnementRepository): Response
    // {
    //     $actif = true;
    //     $searchQuery = $request->query->get('recherche');
    //     $queryBuilder = $abonnementRepository->getSearchQuery($searchQuery,$actif);
    //     $corbeil = $queryBuilder->getResult();

    //     return $this->render('abonnement/corbeil.html.twig', [
    //         'abonnements' => $corbeil,
    //     ]);
    // }

    #[Route('/new', name: 'app_abonnement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $abonnement = new Abonnement();
        $form = $this->createForm(Abonnement1Type::class, $abonnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($abonnement);
            $entityManager->flush();

            return $this->redirectToRoute('app_abonnement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('abonnement/new.html.twig', [
            'abonnement' => $abonnement,
            'form' => $form,
        ]);
    }

    // /**
    // * @Route("/modifier-champ-boolean/{id}",name = "modifier_champ_boolean",methods: {'GET'})
    // */
    // public function modifierChampBoolean($id): Response{
    //     $entityManager= $this->getDoctrine()->getClient();
    //     $votreEntity = $entityManager->getRepository(Abonnement::class)->find($id);

    //     if (!$votreEntity){
    //         throw $this->createNotFoundException('Entité introuvable!');
    //     }
    //     $votreEntity->setActif(!$votreEntity->getActif());
    //     $entityManager->flush();
    //     return $this->redirectToRoute('app_abonnement_index');

    // }


    #[Route('/{id}', name: 'app_abonnement_show', methods: ['GET'])]
    public function show(Abonnement $abonnement): Response
    {
        return $this->render('abonnement/show.html.twig', [
            'abonnement' => $abonnement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_abonnement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Abonnement $abonnement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Abonnement1Type::class, $abonnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_abonnement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('abonnement/edit.html.twig', [
            'abonnement' => $abonnement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_abonnement_delete', methods: ['POST'])]
    public function delete(Request $request, Abonnement $abonnement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$abonnement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($abonnement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_abonnement_index', [], Response::HTTP_SEE_OTHER);
    }
}
