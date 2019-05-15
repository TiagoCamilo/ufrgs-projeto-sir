<?php

namespace App\Controller;

use App\Entity\FormularioCampo;
use App\Entity\IEntity;
use App\Form\FormularioCampoType;
use App\Repository\FormularioCampoRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/formulario_campo")
 */
class FormularioCampoController extends AppAbstractController
{
    public function __construct(FormularioCampoRepository $entityRepository)
    {
        $this->entity = new FormularioCampo();
        $this->entityRepository = $entityRepository;
        $this->entityName = 'formulario_campo';
        $this->formType = FormularioCampoType::class;
    }

    /**
     * @Route("/{page}/page", name="formulario_campo_index", methods="GET|POST", defaults={"page" = 1})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        return parent::index($paginator, $request);
    }

    /**
     * @Route("/new", name="formulario_campo_new", methods="GET|POST")
     */
    public function new(Request $request, UserInterface $user): Response
    {
        return parent::new($request, $user);
    }

    /**
     * @Route("/{id}", name="formulario_campo_show", methods="GET")
     * @ParamConverter("entity", class="App\Entity\FormularioCampo")
     */
    public function show(IEntity $entity): Response
    {
        return parent::show($entity);
    }

    /**
     * @Route("/{id}/edit", name="formulario_campo_edit", methods="GET|POST")
     * @ParamConverter("entity", class="App\Entity\FormularioCampo")
     */
    public function edit(Request $request, IEntity $entity): Response
    {
        return parent::edit($request, $entity);
    }

    /**
     * @Route("/{id}", name="formulario_campo_delete", methods="DELETE")
     * @ParamConverter("entity", class="App\Entity\FormularioCampo")
     */
    public function delete(Request $request, IEntity $entity): Response
    {
        return parent::delete($request, $entity);
    }
}
