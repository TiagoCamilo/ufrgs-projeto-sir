<?php

namespace App\Controller;

use App\Entity\FormularioCampo;
use App\Form\FormularioCampoType;
use App\Repository\FormularioCampoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/formulario/campo")
 */
class FormularioCampoController extends AbstractController
{
    /**
     * @Route("/", name="formulario_campo_index", methods={"GET"})
     */
    public function index(FormularioCampoRepository $formularioCampoRepository): Response
    {
        return $this->render('formulario_campo/index.html.twig', [
            'formulario_campos' => $formularioCampoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="formulario_campo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $formularioCampo = new FormularioCampo();
        $form = $this->createForm(FormularioCampoType::class, $formularioCampo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formularioCampo);
            $entityManager->flush();

            return $this->redirectToRoute('formulario_campo_index');
        }

        return $this->render('formulario_campo/new.html.twig', [
            'formulario_campo' => $formularioCampo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="formulario_campo_show", methods={"GET"})
     */
    public function show(FormularioCampo $formularioCampo): Response
    {
        return $this->render('formulario_campo/show.html.twig', [
            'formulario_campo' => $formularioCampo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="formulario_campo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FormularioCampo $formularioCampo): Response
    {
        $form = $this->createForm(FormularioCampoType::class, $formularioCampo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formulario_campo_index', [
                'id' => $formularioCampo->getId(),
            ]);
        }

        return $this->render('formulario_campo/edit.html.twig', [
            'formulario_campo' => $formularioCampo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="formulario_campo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, FormularioCampo $formularioCampo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formularioCampo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formularioCampo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formulario_campo_index');
    }
}
