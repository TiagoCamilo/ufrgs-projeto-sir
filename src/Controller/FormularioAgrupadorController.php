<?php

namespace App\Controller;

use App\Entity\FormularioAgrupador;
use App\Entity\IEntity;
use App\Form\FormularioAgrupadorType;
use App\Repository\FormularioAgrupadorRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/formulario_agrupador")
 */
class FormularioAgrupadorController extends AppAbstractController
{
    public function __construct(FormularioAgrupadorRepository $entityRepository)
    {
        $this->entity = new FormularioAgrupador();
        $this->entityRepository = $entityRepository;
        $this->entityName = 'formulario_agrupador';
        $this->formType = FormularioAgrupadorType::class;
    }

    /**
     * @Route("/{page}/page", name="formulario_agrupador_index", methods="GET|POST", defaults={"page" = 1})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        return parent::index($paginator, $request);
    }

    /**
     * @Route("/new", name="formulario_agrupador_new", methods="GET|POST")
     */
    public function new(Request $request, UserInterface $user): Response
    {
        return parent::new($request, $user);
    }

    /**
     * @Route("/{id}", name="formulario_agrupador_show", methods="GET")
     * @ParamConverter("entity", class="App\Entity\FormularioAgrupador")
     */
    public function show(IEntity $entity): Response
    {
        return parent::show($entity);
    }

    /**
     * @Route("/{id}/edit", name="formulario_agrupador_edit", methods="GET|POST")
     * @ParamConverter("entity", class="App\Entity\FormularioAgrupador")
     */
    public function edit(Request $request, IEntity $entity): Response
    {
        return parent::edit($request, $entity);
    }

    /**
     * @Route("/{id}", name="formulario_agrupador_delete", methods="DELETE")
     * @ParamConverter("entity", class="App\Entity\FormularioAgrupador")
     */
    public function delete(Request $request, IEntity $entity): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entity->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            foreach ($entity->getFormularioCampos() as $formularioCampo) {
                $entity->removeFormularioCampo($formularioCampo);
            }
            $em->flush();
        }

        return $this->redirectToRoute("{$this->entityName}_index");
    }
}
