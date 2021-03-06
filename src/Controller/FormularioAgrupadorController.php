<?php

namespace App\Controller;

use App\Entity\Formulario;
use App\Entity\FormularioAgrupador;
use App\Entity\EntityInterface;
use App\Form\FormularioAgrupadorType;
use App\Service\TemplateManager;
use App\Repository\FormularioAgrupadorRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/formulario_agrupador")
 */
class FormularioAgrupadorController extends AbstractAppController
{
    public function __construct(FormularioAgrupadorRepository $entityRepository)
    {
        $this->entity = new FormularioAgrupador();
        $this->entityRepository = $entityRepository;
        $this->entityName = 'formulario_agrupador';
        $this->formType = FormularioAgrupadorType::class;
    }

    /**
     * @Route("/{formulario}/{page}/page", name="formulario_agrupador_index", methods="GET|POST", defaults={"page" = 1})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $formulario = $em->getRepository(Formulario::class)->find($request->get('formulario'));
        $this->denyAccessUnlessGranted('formulario_agrupador_list', $formulario);

        $resultSet = $paginator->paginate(
            $this->entityRepository->findByUserContext($this->getUser(), ['formulario' => $formulario]),
            $request->get('page')
        );

        //TODO: Refatorar para obter o response em cada metodo
        return $this->render("{$this->entityName}/index.html.twig", [
            'registers' => $resultSet,
            'entityName' => $this->entityName,
            'template' => (array) $this->getTemplateManager(),
        ]);
    }

    /**
     * @Route("/new", name="formulario_agrupador_new", methods="GET|POST")
     */
    public function new(Request $request, UserInterface $user): Response
    {
        return parent::new($request, $user);
    }

    protected function newSuccessResponse(EntityInterface $entity): Response
    {
        return $this->redirectToRoute("{$this->entityName}_index", ['formulario' => $entity->getFormulario()->getId()]);
    }

    /**
     * @Route("/{id}", name="formulario_agrupador_show", methods="GET")
     * @ParamConverter("entity", class="App\Entity\FormularioAgrupador")
     * @IsGranted("formulario_agrupador_show", subject="entity")
     */
    public function show(EntityInterface $entity): Response
    {
        return parent::show($entity);
    }

    /**
     * @Route("/{id}/edit", name="formulario_agrupador_edit", methods="GET|POST")
     * @ParamConverter("entity", class="App\Entity\FormularioAgrupador")
     */
    public function edit(Request $request, EntityInterface $entity): Response
    {
        return parent::edit($request, $entity);
    }

    protected function editSuccessResponse(EntityInterface $entity): Response
    {
        return $this->redirectToRoute("{$this->entityName}_index", ['formulario' => $entity->getFormulario()->getId()]);
    }

    /**
     * @Route("/{id}", name="formulario_agrupador_delete", methods="DELETE")
     * @ParamConverter("entity", class="App\Entity\FormularioAgrupador")
     */
    public function delete(Request $request, EntityInterface $entity): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entity->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            foreach ($entity->getFormularioCampos() as $formularioCampo) {
                $entity->removeFormularioCampo($formularioCampo);
            }
            $em->flush();
        }

        return $this->redirectToRoute("{$this->entityName}_index", ['formulario' => $entity->getFormulario()->getId()]);
    }

    protected function getTemplateManager(): TemplateManager
    {
        $templateManager = parent::getTemplateManager();
        $templateManager->setIndexActions('formulario_agrupador/_index_registers.html.twig');

        return $templateManager;
    }
}
