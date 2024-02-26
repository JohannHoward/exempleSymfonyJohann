<?php

namespace App\Controller;

use App\Entity\Chaine;
use App\Form\ChaineType;
use App\Repository\ChaineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/chaine')]
class ChaineController extends AbstractController
{
    #[Route('/', name: 'app_chaine_index', methods: ['GET'])]
    public function index(Request $request, ChaineRepository $chaineRepository): Response
    {
        $searchQuery = $request->query->get('recherche');
        $queryBuilder = $chaineRepository->getSearchQuery($searchQuery);
        $chaine = $queryBuilder->getResult();

        return $this->render('chaine/index.html.twig', [
            'chaines' => $chaine,
        ]);
    }

    #[Route('/new', name: 'app_chaine_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $chaine = new Chaine();
        $form = $this->createForm(ChaineType::class, $chaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($chaine);
            $entityManager->flush();

            return $this->redirectToRoute('app_chaine_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chaine/new.html.twig', [
            'chaine' => $chaine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chaine_show', methods: ['GET'])]
    public function show(Chaine $chaine): Response
    {
        return $this->render('chaine/show.html.twig', [
            'chaine' => $chaine,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_chaine_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Chaine $chaine, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChaineType::class, $chaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_chaine_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chaine/edit.html.twig', [
            'chaine' => $chaine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chaine_delete', methods: ['POST'])]
    public function delete(Request $request, Chaine $chaine, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chaine->getId(), $request->request->get('_token'))) {
            $entityManager->remove($chaine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_chaine_index', [], Response::HTTP_SEE_OTHER);
    }
}
