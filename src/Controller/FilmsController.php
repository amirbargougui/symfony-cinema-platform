<?php

namespace App\Controller;

use App\Entity\Films;
use App\Form\FilmsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException; 
use App\Repository\FilmsRepository;


class FilmsController extends AbstractController
{
    #[Route('/films', name: 'app_films_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $films = $entityManager
            ->getRepository(Films::class)
            ->findAll();

        return $this->render('films/index.html.twig', [
            'films' => $films,
        ]);
    }

    #[Route('/films/new', name: 'app_films_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $film = new Films();
        $form = $this->createForm(FilmsType::class, $film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($film);
            $entityManager->flush();

            return $this->redirectToRoute('app_films_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('films/new.html.twig', [
            'film' => $film,
            'form' => $form,
        ]);
    }

    #[Route('/films/{filmid}', name: 'app_films_show', methods: ['GET'])]
    public function show(int $filmid, EntityManagerInterface $entityManager): Response
    {
        // Fetch the Films entity by its identifier
        $film = $entityManager->getRepository(Films::class)->find($filmid);

        // Check if the film exists
        if (!$film) {
            throw new NotFoundHttpException('Film not found');
        }

        return $this->render('films/show.html.twig', [
            'film' => $film,
        ]);
    }

    #[Route('/films/{filmid}/edit', name: 'app_films_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $filmid, EntityManagerInterface $entityManager): Response
    {
        // Fetch the Films entity by its identifier
        $film = $entityManager->getRepository(Films::class)->find($filmid);

        // Check if the film exists
        if (!$film) {
            throw new NotFoundHttpException('Film not found');
        }

        $form = $this->createForm(FilmsType::class, $film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_films_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('films/edit.html.twig', [
            'film' => $film,
            'form' => $form,
        ]);
    }

    #[Route('/films/{filmid}', name: 'app_films_delete', methods: ['POST'])]
    public function delete(Request $request, Films $film, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$film->getFilmid(), $request->request->get('_token'))) {
            $entityManager->remove($film);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_films_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/search', name: 'app_film_search')]
    public function searchFilm(Request $request, FilmsRepository $repository): Response
    {
        $query = $request->request->get('query');
        $films = $repository->searchByTitre($query);
        return $this->render('films/search.html.twig', [
            'films' => $films
        ]);
    }

    #[Route('/stats', name: 'app_films_stat')]
    public function stats(FilmsRepository $repository)
    {
        $stats = $repository->getStatsByCategorie();

        return $this->render('films/stats.html.twig', [
            'stats' => $stats,
        ]);
    }
}
