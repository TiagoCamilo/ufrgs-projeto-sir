<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 14/10/18
 * Time: 09:27.
 */

namespace App\Controller;

use App\Entity\Escola;
use App\Form\EscolaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/escola")
 */
class EscolaController extends AbstractController
{
    /**
     * @Route("/", name="escola_index", methods="GET")
     */
    public function index(): Response
    {
        $escolaRepository = $this->getDoctrine()->getRepository(Escola::class);

        return $this->render('escola/index.html.twig', ['escolas' => $escolaRepository->findAll()]);
    }

    /**
     * @Route("/new", name="escola_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $escola = new Escola();

        $form = $this->createForm(EscolaType::class, $escola);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($escola);
            $entityManager->flush();

            return $this->redirectToRoute('escola_index');
        }

        return $this->render('escola/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/{id}", name="escola_show", methods="GET")
     */
    public function show(Request $request): Response
    {
        $escolaRepository = $this->getDoctrine()->getRepository(Escola::class);
        $escola = $escolaRepository->find($request->get('id'));

        return $this->render('escola/show.html.twig', ['escola' => $escola]);
    }

    /**
     * @Route("/{id}/edit", name="escola_edit", methods="GET|POST")
     */
    public function edit(Request $request): Response
    {
        $escola = $this->getDoctrine()->getRepository(Escola::class)->find($request->get('id'));
        $form = $this->createForm(EscolaType::class, $escola);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($escola);
            $entityManager->flush();

            return $this->redirectToRoute('escola_index');
        }

        return $this->render('escola/edit.html.twig', ['form' => $form->createView(), 'escola' => $escola]);
    }

    /**
     * @Route("/{id}/delete", name="escola_delete", methods="DELETE")
     */
    public function delete(Request $request): Response
    {
        $escola = $this->getDoctrine()->getRepository(Escola::class)->find($request->get('id'));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($escola);
        $entityManager->flush();

        return $this->redirectToRoute('escola_index');
    }
}
