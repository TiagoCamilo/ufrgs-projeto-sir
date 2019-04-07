<?php

namespace App\Controller;

use App\Entity\Formulario;
use App\Form\FormularioDinamicoType;
use App\Repository\FormularioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/formulario_dinamico")
 */
class FormularioDinamicoController extends AbstractController
{
    /**
     * @Route("/", name="formulario_dinamico_index", methods={"GET"})
     */
    public function index(FormularioRepository $formularioRepository): Response
    {
        return $this->render('formulario_dinamico/index.html.twig', [
            'formularios' => $formularioRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="formulario_dinamico_new", methods={"GET","POST"})
     */
    public function new(Request $request, FormularioRepository $formularioRepository): Response
    {

        $formulario = $formularioRepository->find(1);
        foreach ($formulario->getFormularioCampos() as $campo) {
            dump($request->request->get($campo->getId()));
        }

        die();
    }

    /**
     * @Route("/{id}", name="formulario_dinamico_show", methods={"GET"})
     */
    public function show(Formulario $formulario): Response
    {
        return $this->render('formulario_dinamico/show.html.twig', [
            'formulario' => $formulario,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="formulario_dinamico_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formulario $formulario): Response
    {
        $form = $this->createForm(FormularioDinamicoType::class, $formulario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formulario_dinamico_index', [
                'id' => $formulario->getId(),
            ]);
        }

        return $this->render('formulario_dinamico/edit.html.twig', [
            'formulario' => $formulario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="formulario_dinamico_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Formulario $formulario): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formulario->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formulario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formulario_dinamico_index');
    }
}
