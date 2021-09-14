<?php

namespace App\Controller;

use App\Entity\Reply;
use App\Entity\Ticket;
use App\Form\ReplyType;
use App\Repository\ReplyRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\TicketRepository;

use function PHPUnit\Framework\returnSelf;

class TicketController extends AbstractController
{
    /**
     * @Route("/ticket/{id}", name="ticket")
     */
    public function index(Request $request, TicketRepository $ticketRepository, $id, ReplyRepository $replyRepository): Response
    {
        $ticket = $ticketRepository->findOneBy(['id' => $id]);
        $reply = new Reply();   
        $form = $this->createForm(ReplyType::class, $reply);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $reply->setCreatedAt(new \DateTime());
            $reply->setTicket($ticket); 

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reply);
            $entityManager->flush();

            $this->addFlash('message', "Reply sent");

            return $this->redirectToRoute('ticket', ['id' => $ticket->getId()]);
            // return $this->redirectToRoute('home');
        }

        return $this->render('ticket/index.html.twig', [
            'ticket' => $ticketRepository->find($id),
            'form' => $form->createView(),
            
        ]);
    }
}
