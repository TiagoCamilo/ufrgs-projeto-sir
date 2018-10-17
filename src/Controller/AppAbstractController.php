<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 16/10/18
 * Time: 18:45.
 */

namespace App\Controller;

use App\Entity\IEntity;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AppAbstractController extends AbstractController
{
    protected $entity;
    protected $entityRepository;
    protected $entityTemplateName;
    protected $formType;

    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        //TODO: Replicar pagination para outras entidades
        $resultSet = $paginator->paginate(
            $this->entityRepository->findAll(),
            $request->get('page')
        );

        return $this->render("{$this->entityTemplateName}/index.html.twig", ['registers' => $resultSet]);
    }

    public function new(Request $request): Response
    {
        $form = $this->createForm($this->formType, $this->entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($this->entity);
            $em->flush();

            return $this->redirectToRoute("{$this->entityTemplateName}_index");
        }

        return $this->render("{$this->entityTemplateName}/new.html.twig", [
            'form' => $form->createView(),
        ]);
    }

    public function show(IEntity $entity): Response
    {
        return $this->render("{$this->entityTemplateName}/show.html.twig", ['register' => $entity]);
    }

    public function edit(Request $request, IEntity $entity): Response
    {
        $form = $this->createForm($this->formType, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute("{$this->entityTemplateName}_edit", ['id' => $entity->getId()]);
        }

        return $this->render("{$this->entityTemplateName}/edit.html.twig", [
            'register' => $entity,
            'form' => $form->createView(),
        ]);
    }

    public function delete(Request $request, IEntity $entity): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entity->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirectToRoute("{$this->entityTemplateName}_index");
    }
}
