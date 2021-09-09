<?php

namespace App\Controller;

use App\Entity\Reply;
use App\Form\Reply1Type;
use App\Repository\ReplyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reply")
 */
class ReplyController extends AbstractController
{
    /**
     * @Route("/", name="reply_index", methods={"GET"})
     */
    public function index(ReplyRepository $replyRepository): Response
    {
        return $this->render('reply/index.html.twig', [
            'replies' => $replyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="reply_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reply = new Reply();
        $form = $this->createForm(Reply1Type::class, $reply);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reply);
            $entityManager->flush();

            return $this->redirectToRoute('reply_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reply/new.html.twig', [
            'reply' => $reply,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="reply_show", methods={"GET"})
     */
    public function show(Reply $reply): Response
    {
        return $this->render('reply/show.html.twig', [
            'reply' => $reply,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reply_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reply $reply): Response
    {
        $form = $this->createForm(Reply1Type::class, $reply);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reply_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reply/edit.html.twig', [
            'reply' => $reply,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="reply_delete", methods={"POST"})
     */
    public function delete(Request $request, Reply $reply): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reply->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reply);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reply_index', [], Response::HTTP_SEE_OTHER);
    }
}
