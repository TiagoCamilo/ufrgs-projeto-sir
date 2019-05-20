<?php

namespace App\Controller;

use App\Entity\Acompanhamento;
use App\Entity\IEntity;
use App\Form\AcompanhamentoType;
use App\Helpers\TemplateManager;
use App\Repository\AcompanhamentoRepository;
use App\Service\PdfGenerator;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/acompanhamento")
 */
class AcompanhamentoController extends AppAbstractController
{
    public function __construct(AcompanhamentoRepository $entityRepository)
    {
        $this->entity = new Acompanhamento();
        $this->entityRepository = $entityRepository;
        $this->entityName = 'acompanhamento';
        $this->formType = AcompanhamentoType::class;
    }

    /**
     * @Route("/{page}/page", name="acompanhamento_index", methods="GET|POST", defaults={"page" = 1})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        return parent::index($paginator, $request);
    }

    /**
     * @Route("/new", name="acompanhamento_new", methods="GET|POST")
     */
    public function new(Request $request, UserInterface $user): Response
    {
        $form = $this->createForm($this->formType, $this->entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // TODO: Isolar em metodo dependente de UserInterface?
            $this->entity->setEducador($user->getEducador());

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
     * @Route("/{id}", name="acompanhamento_show", methods="GET")
     * @ParamConverter("entity", class="App\Entity\Acompanhamento")
     */
    public function show(IEntity $entity): Response
    {
        return parent::show($entity);
    }

    /**
     * @Route("/{id}/edit", name="acompanhamento_edit", methods="GET|POST")
     * @ParamConverter("entity", class="App\Entity\Acompanhamento")
     */
    public function edit(Request $request, IEntity $entity): Response
    {
        return parent::edit($request, $entity);
    }

    /**
     * @Route("/{id}", name="acompanhamento_delete", methods="DELETE")
     * @ParamConverter("entity", class="App\Entity\Acompanhamento")
     */
    public function delete(Request $request, IEntity $entity): Response
    {
        return parent::delete($request, $entity);
    }

    protected function getTemplateManager(): TemplateManager
    {
        $templateManager = parent::getTemplateManager();
        $templateManager->setNew('acompanhamento/new.html.twig');
        $templateManager->setEdit('acompanhamento/edit.html.twig');

        return $templateManager;
    }

    /**
     * @Route("/{id}/pdf", name="acompanhamento_report_pdf", methods="GET")
     * @ParamConverter("entity", class="App\Entity\Acompanhamento")
     */
    public function reportPdf(IEntity $entity, PdfGenerator $pdfGenerator): Response
    {
        $html = $this->renderView('acompanhamento/report_pdf.html.twig', [
            'register' => $entity,
            'title' => 'Formulário Acompanhamento',
        ]);

        $pdfGenerator->setStyle('report_pdf.css');
        $pdfGenerator->setContent($html);

        return $pdfGenerator->generate();
    }
}
