<?php

namespace App\Controller;

use App\Entity\Aluno;
use App\Entity\IEntity;
use App\Form\AlunoFile;
use App\Form\AlunoType;
use App\Repository\AlunoRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/aluno")
 */
class AlunoController extends AppAbstractController
{
    public function __construct(AlunoRepository $entityRepository)
    {
        $this->entity = new Aluno();
        $this->entityRepository = $entityRepository;
        $this->entityName = 'aluno';
        $this->formType = AlunoType::class;
    }

    /**
     * @Route("/{page}/page", name="aluno_index", methods="GET|POST", defaults={"page" = 1})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        return parent::index($paginator, $request);
    }

    /**
     * @Route("/new", name="aluno_new", methods="GET|POST")
     */
    public function new(Request $request, UserInterface $user): Response
    {
        return parent::new($request, $user);
    }

    /**
     * @Route("/{id}", name="aluno_show", methods="GET")
     * @ParamConverter("entity", class="App\Entity\Aluno")
     * @IsGranted("VIEW", subject="entity")
     */
    public function show(IEntity $entity): Response
    {
        return parent::show($entity);
    }

    /**
     * @Route("/{id}/edit", name="aluno_edit", methods="GET|POST")
     * @ParamConverter("entity", class="App\Entity\Aluno")
     */
    public function edit(Request $request, IEntity $entity): Response
    {
        return parent::edit($request, $entity);
    }

    /**
     * @Route("/{id}", name="aluno_delete", methods="DELETE")
     * @ParamConverter("entity", class="App\Entity\Aluno")
     */
    public function delete(Request $request, IEntity $entity): Response
    {
        return parent::delete($request, $entity);
    }

    /**
     * @Route("/image/{id}", name="aluno_image", methods="GET|POST")
     * @ParamConverter("entity", class="App\Entity\Aluno")
     */
    public function image(Request $request, IEntity $entity): Response
    {
        $form = $this->createForm(AlunoFile::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute("{$this->entityName}_image", ['id' => $entity->getId()]);
        }

        return $this->render('aluno/image.html.twig', [
            'register' => $entity,
            'form' => $form->createView(),
            'entityName' => $this->entityName,
        ]);
    }
}
