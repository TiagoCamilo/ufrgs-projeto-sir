<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 16/10/18
 * Time: 18:45.
 */

namespace App\Controller;

use App\Entity\EntityInterface;
use App\Repository\AbstractRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\TemplateManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

abstract class AbstractAppController extends AbstractController
{
    protected $entity;
    protected $entityRepository;
    protected $entityName;
    protected $entityDisplayedName = null;
    protected $formType;
    protected $aluno;

    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $resultSet = $paginator->paginate(
            $this->entityRepository->findAllByUserContext($this->getUser()),
            $request->get('page')
        );

        return $this->render("{$this->entityName}/index.html.twig", [
            'registers' => $resultSet,
            'entityName' => $this->entityName,
            'template' => (array) $this->getTemplateManager(),
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

            return $this->newSuccessResponse($this->entity);
        }

        return $this->render($this->getTemplateManager()->getNew(), [
            'form' => $form->createView(),
            'entityName' => $this->entityName,
            'entityDisplayedName' => $this->entityDisplayedName,
            'template' => (array) $this->getTemplateManager(),
        ]);
    }

    protected function newSuccessResponse(EntityInterface $entity): Response
    {
        return $this->redirectToRoute("{$this->entityName}_index");
    }

    public function show(EntityInterface $entity): Response
    {
        return $this->render("{$this->entityName}/show.html.twig", [
            'register' => $entity,
            'entityName' => $this->entityName,
            'template' => (array) $this->getTemplateManager(),
        ]);
    }

    public function edit(Request $request, EntityInterface $entity): Response
    {
        $form = $this->getForm($entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            //Sempre que houver aluno "em sessao", volta para o perfil do mesmo
            if (null !== $this->aluno && null !== $this->aluno->getId()) {
                return $this->redirectToRoute('perfil_aluno_profile', [
                    'id' => $this->aluno->getId(),
                ]);
            }

            return $this->editSuccessResponse($entity);
        }

        return $this->render($this->getTemplateManager()->getEdit(), [
            'register' => $entity,
            'form' => $form->createView(),
            'entityName' => $this->entityName,
            'entityDisplayedName' => $this->entityDisplayedName,
            'template' => (array) $this->getTemplateManager(),
        ]);
    }

    protected function editSuccessResponse(EntityInterface $entity): Response
    {
        return $this->redirectToRoute("{$this->entityName}_index");
    }

    public function delete(Request $request, EntityInterface $entity): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entity->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
        }

        //Sempre que houver aluno "em sessao", volta para o perfil do mesmo
        if (null !== $this->aluno && null !== $this->aluno->getId()) {
            return $this->redirectToRoute('perfil_aluno_profile', [
                'id' => $this->aluno->getId(),
            ]);
        }

        return $this->deleteSuccessResponse($entity);
    }

    protected function deleteSuccessResponse(EntityInterface $entity): Response
    {
        return $this->redirectToRoute("{$this->entityName}_index");
    }

    protected function getForm(EntityInterface $entity)
    {
        return $this->createForm($this->formType, $entity);
    }

    protected function getTemplateManager(): TemplateManager
    {
        $templateManager = new TemplateManager();
        $templateManager->setEdit('generic/edit.html.twig');
        $templateManager->setNew('generic/new.html.twig');
        $templateManager->setForm('generic/_form.html.twig');
        $templateManager->setDelete('generic/_delete_form.html.twig');
        $templateManager->setIndexActions('generic/_index_registers.html.twig');
        $templateManager->setIndexFooter('generic/_index_footer.html.twig');
        $templateManager->setShowActions('generic/_show_actions.html.twig');

        return $templateManager;
    }
}
