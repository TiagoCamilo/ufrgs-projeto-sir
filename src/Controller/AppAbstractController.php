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
use Symfony\Component\Security\Core\User\UserInterface;

abstract class AppAbstractController extends AbstractController
{
    protected $entity;
    protected $entityRepository;
    protected $entityName;
    protected $entityTemplate = 'generic';
    protected $formType;

    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $resultSet = $paginator->paginate(
            $this->entityRepository->findAll(),
            $request->get('page')
        );

        //TODO: Refatorar para obter o response em cada metodo
        return $this->render("{$this->entityName}/index.html.twig", [
            'registers' => $resultSet,
            'template' => $this->entityTemplate,
            'entityName' => $this->entityName,
        ]);
    }


    public function new(Request $request, UserInterface $user): Response
    {
        $form = $this->createForm($this->formType, $this->entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($this->entity);
            $em->flush();

            return $this->redirectToRoute("{$this->entityName}_index");
        }

        return $this->render("{$this->entityTemplate}/new.html.twig", [
            'form' => $form->createView(),
            'template' => $this->entityTemplate,
            'entityName' => $this->entityName,
        ]);
    }

    public function show(IEntity $entity): Response
    {
        //TODO: Refatorar para obter o response em cada metodo
        return $this->render("{$this->entityName}/show.html.twig", [
            'register' => $entity,
            'template' => $this->entityTemplate,
            'entityName' => $this->entityName,
        ]);
    }

    public function edit(Request $request, IEntity $entity): Response
    {
        $form = $this->createForm($this->formType, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute("{$this->entityName}_edit", ['id' => $entity->getId()]);
        }

        return $this->render("{$this->entityTemplate}/edit.html.twig", [
            'register' => $entity,
            'form' => $form->createView(),
            'template' => $this->entityTemplate,
            'entityName' => $this->entityName,
        ]);
    }

    public function delete(Request $request, IEntity $entity): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entity->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirectToRoute("{$this->entityName}_index");
    }
}
