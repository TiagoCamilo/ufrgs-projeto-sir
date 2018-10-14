<?php

namespace App\Controller;

use App\Entity\Aluno;
use App\Form\AlunoSearch;
use App\Form\AlunoType;
use App\Repository\AlunoRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/aluno")
 */
class AlunoController extends AbstractController
{
    /**
     * @Route("/{page}/page", name="aluno_index", methods="GET|POST", defaults={"page" = 1})
     */
    public function index(AlunoRepository $alunoRepository, PaginatorInterface $paginator, Request $request, Session $session): Response
    {
        $form = $this->createForm(AlunoSearch::class);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $session->set('nome',  $form->get('nome')->getData());
        }

        $searchedValue = $session->get('nome') ?? null;

        if($searchedValue !== null) {
            $registers = $alunoRepository->createQueryBuilder('e')
                ->where('e.nome like :nome')
                ->setParameter('nome', "%{$searchedValue}%");
        } else{
            $registers = $alunoRepository->findAll();
        }

        //TODO: Replicar pagination para outras entidades
        $resultSet = $paginator->paginate(
            $registers,
            $request->get("page")
        );

        return $this->render('aluno/index.html.twig', [
            'alunos' => $resultSet,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/new", name="aluno_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $aluno = new Aluno();
        $form = $this->createForm(AlunoType::class, $aluno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($aluno);
            $em->flush();

            return $this->redirectToRoute('aluno_index');
        }

        return $this->render('aluno/new.html.twig', [
            'aluno' => $aluno,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="aluno_show", methods="GET")
     */
    public function show(Aluno $aluno): Response
    {
        return $this->render('aluno/show.html.twig', ['aluno' => $aluno]);
    }

    /**
     * @Route("/{id}/edit", name="aluno_edit", methods="GET|POST")
     */
    public function edit(Request $request, Aluno $aluno): Response
    {
        $form = $this->createForm(AlunoType::class, $aluno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('aluno_edit', ['id' => $aluno->getId()]);
        }

        return $this->render('aluno/edit.html.twig', [
            'aluno' => $aluno,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="aluno_delete", methods="DELETE")
     */
    public function delete(Request $request, Aluno $aluno): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aluno->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($aluno);
            $em->flush();
        }

        return $this->redirectToRoute('aluno_index');
    }
}
