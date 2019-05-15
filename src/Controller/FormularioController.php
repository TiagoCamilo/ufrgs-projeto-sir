<?php

namespace App\Controller;

use App\Entity\Formulario;
use App\Entity\IEntity;
use App\Form\FormularioType;
use App\Repository\FormularioRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/formulario")
 */
class FormularioController extends AppAbstractController
{
    public function __construct(FormularioRepository $entityRepository)
    {
        $this->entity = new Formulario();
        $this->entityRepository = $entityRepository;
        $this->entityName = 'formulario';
        $this->formType = FormularioType::class;
    }

    /**
     * @Route("/{page}/page", name="formulario_index", methods="GET|POST", defaults={"page" = 1})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        return parent::index($paginator, $request);
    }

    /**
     * @Route("/new", name="formulario_new", methods="GET|POST")
     */
    public function new(Request $request, UserInterface $user): Response
    {
        return parent::new($request, $user);
    }

    /**
     * @Route("/{id}", name="formulario_show", methods="GET")
     * @ParamConverter("entity", class="App\Entity\Formulario")
     */
    public function show(IEntity $entity): Response
    {
        return parent::show($entity);
    }

    /**
     * @Route("/{id}/edit", name="formulario_edit", methods="GET|POST")
     * @ParamConverter("entity", class="App\Entity\Formulario")
     */
    public function edit(Request $request, IEntity $entity): Response
    {
        return parent::edit($request, $entity);
    }

    /**
     * @Route("/{id}", name="formulario_delete", methods="DELETE")
     * @ParamConverter("entity", class="App\Entity\Formulario")
     */
    public function delete(Request $request, IEntity $entity): Response
    {
        return parent::delete($request, $entity);
    }
}
