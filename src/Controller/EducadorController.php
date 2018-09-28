<?php

namespace App\Controller;

use App\Entity\Educador;
use App\Form\EducadorType;
use App\Repository\EducadorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/educador")
 */
class EducadorController extends AbstractController
{
    /**
     * @Route("/", name="educador_index", methods="GET")
     */
    public function index(EducadorRepository $educadorRepository): Response
    {
        return $this->render('educador/index.html.twig', ['educadors' => $educadorRepository->findAll()]);
    }

    /**
     * @Route("/new", name="educador_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $educador = new Educador();
        $form = $this->createForm(EducadorType::class, $educador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($educador);
            $em->flush();

            return $this->redirectToRoute('educador_index');
        }

        return $this->render('educador/new.html.twig', [
            'educador' => $educador,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="educador_show", methods="GET")
     */
    public function show(Educador $educador): Response
    {
        return $this->render('educador/show.html.twig', ['educador' => $educador]);
    }

    /**
     * @Route("/{id}/edit", name="educador_edit", methods="GET|POST")
     */
    public function edit(Request $request, Educador $educador): Response
    {
        $form = $this->createForm(EducadorType::class, $educador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('educador_edit', ['id' => $educador->getId()]);
        }

        return $this->render('educador/edit.html.twig', [
            'educador' => $educador,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="educador_delete", methods="DELETE")
     */
    public function delete(Request $request, Educador $educador): Response
    {
        if ($this->isCsrfTokenValid('delete'.$educador->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($educador);
            $em->flush();
        }

        return $this->redirectToRoute('educador_index');
    }
}
