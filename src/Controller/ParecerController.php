<?php

namespace App\Controller;

use App\Entity\Parecer;
use App\Form\ParecerType;
use App\Repository\ParecerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/parecer")
 */
class ParecerController extends AbstractController
{
    /**
     * @Route("/", name="parecer_index", methods={"GET"})
     */
    public function index(ParecerRepository $parecerRepository): Response
    {
        return $this->render('parecer/index.html.twig', [
            'parecers' => $parecerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="parecer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $parecer = new Parecer();
        $form = $this->createForm(ParecerType::class, $parecer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parecer);
            $entityManager->flush();

            return $this->redirectToRoute('parecer_index');
        }

        return $this->render('parecer/new.html.twig', [
            'parecer' => $parecer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="parecer_show", methods={"GET"})
     */
    public function show(Parecer $parecer): Response
    {
        return $this->render('parecer/show.html.twig', [
            'parecer' => $parecer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="parecer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Parecer $parecer): Response
    {
        $form = $this->createForm(ParecerType::class, $parecer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('parecer_index', [
                'id' => $parecer->getId(),
            ]);
        }

        return $this->render('parecer/edit.html.twig', [
            'parecer' => $parecer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="parecer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Parecer $parecer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parecer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($parecer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('parecer_index');
    }
}
