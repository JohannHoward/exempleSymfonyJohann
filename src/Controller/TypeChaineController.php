<?php

namespace App\Controller;

use App\Entity\TypeChaine;
use App\Form\TypeChaineType;
use App\Repository\TypeChaineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/type/chaine')]
class TypeChaineController extends AbstractController
{
    #[Route('/', name: 'app_type_chaine_index', methods: ['GET'])]
    public function index(Request $request, TypeChaineRepository $typeChaineRepository): Response
    {
        $searchQuery = $request->query->get('recherche');
        $queryBuilder = $typeChaineRepository->getSearchQuery($searchQuery);
        $typeChaine = $queryBuilder->getResult();

        return $this->render('type_chaine/index.html.twig', [
            'type_chaines' => $typeChaine,
        ]);
    }

    #[Route('/new', name: 'app_type_chaine_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeChaine = new TypeChaine();
        $form = $this->createForm(TypeChaineType::class, $typeChaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeChaine);
            $entityManager->flush();

            return $this->redirectToRoute('app_type_chaine_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_chaine/new.html.twig', [
            'type_chaine' => $typeChaine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_chaine_show', methods: ['GET'])]
    public function show(TypeChaine $typeChaine): Response
    {
        return $this->render('type_chaine/show.html.twig', [
            'type_chaine' => $typeChaine,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_chaine_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeChaine $typeChaine, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeChaineType::class, $typeChaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_type_chaine_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_chaine/edit.html.twig', [
            'type_chaine' => $typeChaine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_chaine_delete', methods: ['POST'])]
    public function delete(Request $request, TypeChaine $typeChaine, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeChaine->getId(), $request->request->get('_token'))) {
            $entityManager->remove($typeChaine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_type_chaine_index', [], Response::HTTP_SEE_OTHER);
    }
}
