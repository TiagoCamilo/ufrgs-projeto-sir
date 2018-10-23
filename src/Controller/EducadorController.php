<?php

namespace App\Controller;

use App\Entity\Educador;
use App\Entity\IEntity;
use App\Form\EducadorType;
use App\Repository\EducadorRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/educador")
 */
class EducadorController extends AppAbstractController
{
    public function __construct(EducadorRepository $entityRepository)
    {
        $this->entity = new Educador();
        $this->entityRepository = $entityRepository;
        $this->entityName = 'educador';
        $this->formType = EducadorType::class;
    }

    /**
     * @Route("/{page}/page", name="educador_index", methods="GET|POST", defaults={"page" = 1})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        return parent::index($paginator, $request);
    }

    /**
     * @Route("/new", name="educador_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        return parent::new($request);
    }

    /**
     * @Route("/{id}", name="educador_show", methods="GET")
     * @ParamConverter("entity", class="App\Entity\Educador")
     */
    public function show(IEntity $entity): Response
    {
        return parent::show($entity);
    }

    /**
     * @Route("/{id}/edit", name="educador_edit", methods="GET|POST")
     * @ParamConverter("entity", class="App\Entity\Educador")
     */
    public function edit(Request $request, IEntity $entity): Response
    {
        return parent::edit($request, $entity);
    }

    /**
     * @Route("/{id}", name="educador_delete", methods="DELETE")
     * @ParamConverter("entity", class="App\Entity\Educador")
     */
    public function delete(Request $request, IEntity $entity): Response
    {
        return parent::delete($request, $entity);
    }
}
