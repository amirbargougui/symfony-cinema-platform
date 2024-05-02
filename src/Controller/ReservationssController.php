<?php

namespace App\Controller;

use App\Entity\Reservations;
use App\Form\Reservations1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reservationss')]
class ReservationssController extends AbstractController
{
    #[Route('/', name: 'app_reservationss_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reservations = $entityManager
            ->getRepository(Reservations::class)
            ->findAll();

        return $this->render('reservationss/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    #[Route('/new', name: 'admin_reservations_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $reservation = new Reservations();
        $form = $this->createForm(Reservations1Type::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('admin_reservations_index');
        }

        return $this->render('reservationss/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_reservations_edit', methods: ['GET', 'POST'])]
public function edit(Request $request, int $id): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $reservation = $entityManager->getRepository(Reservations::class)->find($id);

    if (!$reservation) {
        throw $this->createNotFoundException('Réservation non trouvée');
    }

    $form = $this->createForm(Reservations1Type::class, $reservation);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();

        return $this->redirectToRoute('admin_reservations_index');
    }

    return $this->render('reservationss/edit.html.twig', [
        'reservation' => $reservation,
        'form' => $form->createView(),
    ]);
}

#[Route('/{id}', name: 'admin_reservations_delete', methods: ['POST'])]
public function delete(Request $request, int $id): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $reservation = $entityManager->getRepository(Reservations::class)->find($id);

    if (!$reservation) {
        throw $this->createNotFoundException('Réservation non trouvée');
    }

    // Vérifier la validité du jeton CSRF
    $token = $request->request->get('_token');
    if (!$this->isCsrfTokenValid('delete'.$reservation->getReservationid(), $token)) {
        throw $this->createAccessDeniedException('Jeton CSRF non valide');
    }

    // Supprimer les sièges liés à la réservation
    $sieges = $reservation->getSieges();
    foreach ($sieges as $siege) {
        $entityManager->remove($siege);
    }

    // Supprimer la réservation
    $entityManager->remove($reservation);
    $entityManager->flush();

    // Redirection vers la page d'accueil après suppression
    return $this->redirectToRoute('admin_reservations_index');
}



}