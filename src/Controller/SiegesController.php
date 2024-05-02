<?php

namespace App\Controller;

use App\Entity\Sieges;
use App\Form\SiegesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

#[Route('/sieges')]
class SiegesController extends AbstractController
{
    #[Route('/', name: 'app_sieges_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $sieges = $entityManager
            ->getRepository(Sieges::class)
            ->findAll();

        return $this->render('sieges/index.html.twig', [
            'sieges' => $sieges,
        ]);
    }

    #[Route('/new', name: 'app_sieges_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $siege = new Sieges();
        $form = $this->createForm(SiegesType::class, $siege);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($siege);
            $entityManager->flush();

            return $this->redirectToRoute('app_sieges_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sieges/new.html.twig', [
            'siege' => $siege,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{siegeid}', name: 'app_sieges_show', methods: ['GET'])]
    #[ParamConverter('siege', class: Sieges::class)]
    public function show(Sieges $siege): Response
    {
        return $this->render('sieges/show.html.twig', [
            'siege' => $siege,
        ]);
    }

    #[Route('/{siegeid}/edit', name: 'app_sieges_edit', methods: ['GET', 'POST'])]
    #[ParamConverter('siege', class: Sieges::class)]
    public function edit(Request $request, Sieges $siege, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SiegesType::class, $siege);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_sieges_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sieges/edit.html.twig', [
            'siege' => $siege,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/sieges/{siegeid}', name: 'app_sieges_delete', methods: ['POST'])]
    public function delete(Request $request, $siegeid, EntityManagerInterface $entityManager): Response
    {
        // Récupérez le siège à supprimer en fonction de son ID
        $siege = $entityManager->getRepository(Sieges::class)->find($siegeid);
    
        // Vérifiez si le token CSRF est valide
        if ($this->isCsrfTokenValid('delete' . $siegeid, $request->request->get('_token'))) {
            // Supprimez le siège
            $entityManager->remove($siege);
            $entityManager->flush();
        }
    
        return $this->redirectToRoute('app_sieges_index');
    }
    
}
