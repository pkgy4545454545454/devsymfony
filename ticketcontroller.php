<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\TicketTypeForm;
use App\Entity\Ticket;
use App\Repository\TicketRepository;

class TicketController extends AbstractController
{
    private $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    /**
     * @Route("/tickets", name="app_ticket")
     */
    public function index()
    {
        return $this->render('ticket/index.html.twig');
    }

    /**
     * @Route("/tickets/add", name="app_ticket_add")
     */
    public function add(Request $request)
    {
        $form = new TicketTypeForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticket = new Ticket();
            $ticket->setAuteur($request->get('auteur'));
            $ticket->setDescription($request->get('description'));
            $ticket->setCatégorie($request->get('catégorie'));

            $this->ticketRepository->save($ticket);

            return $this->redirectToRoute('app_ticket');
        }

        return $this->render('ticket/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/tickets/{id}/modify", name="app_ticket_modify")
     */
    public function modify(Ticket $ticket, Request $request)
    {
        $form = new ModifierTicketTypeForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticket->setAuteur($request->get('auteur'));
            $ticket->setDescription($request->get('description'));
            $ticket->setCatégorie($request->get('catégorie'));
            $ticket->setStatut($request->get('statut'));

            $this->ticketRepository->save($ticket);

            return $this->redirectToRoute('app_ticket');
        }

        return $this->render('ticket/modify.html.twig', [
            'form' => $form->createView(),
            'ticket' => $ticket
        ]);
    }
}