<?php

namespace App\Controller;

use App\Entity\Aluno;
use App\Entity\Comentario;
use App\Entity\IEntity;
use App\Form\ComentarioType;
use App\Helpers\TemplateManager;
use App\Repository\ComentarioRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/comentario")
 */
class ComentarioController extends AppAbstractController
{
    public function __construct(ComentarioRepository $entityRepository)
    {
        $this->entity = new Comentario();
        $this->entityRepository = $entityRepository;
        $this->entityName = 'comentario';
        $this->formType = ComentarioType::class;
    }

    /**
     * @Route("/{page}/page", name="comentario_index", methods="GET|POST", defaults={"page" = 1})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        return parent::index($paginator, $request);
    }

    /**
     * @Route("/new", name="comentario_new", methods="GET|POST")
     */
    public function new(Request $request, UserInterface $user): Response
    {
        $form = $this->createForm($this->formType, $this->entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // TODO: Isolar em metodo dependente de UserInterface?
            $this->entity->setEducador($user->getEducador());

            //TODO: Setar aluno selecionado para "aula"
            $alunoList = $this->getDoctrine()->getRepository(Aluno::class)->findAll();
            $this->entity->setAluno($alunoList[0]);

            $em = $this->getDoctrine()->getManager();
            $em->persist($this->entity);
            $em->flush();

            return $this->redirectToRoute("{$this->entityName}_index");
        }

        return $this->render($this->getTemplateManager()->getNew(), [
            'form' => $form->createView(),
            'entityName' => $this->entityName,
            'template' => (array) $this->getTemplateManager(),
        ]);
    }

    /**
     * @Route("/{id}", name="comentario_show", methods="GET")
     * @ParamConverter("entity", class="App\Entity\Comentario")
     */
    public function show(IEntity $entity): Response
    {
        return parent::show($entity);
    }

    /**
     * @Route("/{id}/edit", name="comentario_edit", methods="GET|POST")
     * @ParamConverter("entity", class="App\Entity\Comentario")
     */
    public function edit(Request $request, IEntity $entity): Response
    {
        return parent::edit($request, $entity);
    }

    /**
     * @Route("/{id}", name="comentario_delete", methods="DELETE")
     * @ParamConverter("entity", class="App\Entity\Comentario")
     */
    public function delete(Request $request, IEntity $entity): Response
    {
        return parent::delete($request, $entity);
    }

    protected function getTemplateManager(): TemplateManager
    {
        $templateManager = parent::getTemplateManager();

        return $templateManager;
    }
}
