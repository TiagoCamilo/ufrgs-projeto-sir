<?php

namespace App\Controller;

use App\Entity\Parecer;
use App\Entity\IEntity;
use App\Form\ParecerType;
use App\Helpers\TemplateManager;
use App\Repository\ParecerRepository;
use App\Repository\AlunoRepository;
use App\Service\PdfGenerator;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/parecer")
 */
class ParecerController extends AppAbstractController
{
    protected $aluno;

    public function __construct(ParecerRepository $entityRepository, SessionInterface $session, AlunoRepository $alunoRepository)
    {
        $this->entity = new Parecer();
        $this->entityRepository = $entityRepository;
        $this->entityName = 'parecer';
        $this->formType = ParecerType::class;

        if (null !== $session->get('aluno_id')) {
            $this->aluno = $alunoRepository->find($session->get('aluno_id'));
        }
    }

    /**
     * @Route("/{page}/page", name="parecer_index", methods="GET|POST", defaults={"page" = 1})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        return parent::index($paginator, $request);
    }

    /**
     * @Route("/new", name="parecer_new", methods="GET|POST")
     */
    public function new(Request $request, UserInterface $user): Response
    {
        $form = $this->createForm($this->formType, $this->entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // TODO: Isolar em metodo dependente de UserInterface?
            $this->entity->setUsuario($user);

            $this->entity->setAluno($this->aluno);

            $em = $this->getDoctrine()->getManager();
            $em->persist($this->entity);
            $em->flush();

            //return $this->redirectToRoute("{$this->entityName}_index");
            return $this->redirectToRoute('perfil_aluno_profile', [
                'id' => $this->aluno->getId(),
            ]);
        }

        return $this->render($this->getTemplateManager()->getNew(), [
            'form' => $form->createView(),
            'entityName' => $this->entityName,
            'template' => (array) $this->getTemplateManager(),
            'aluno' => $this->aluno,
        ]);
    }

    /**
     * @Route("/{id}", name="parecer_show", methods="GET")
     * @ParamConverter("entity", class="App\Entity\Parecer")
     */
    public function show(IEntity $entity): Response
    {
        return parent::show($entity);
    }

    /**
     * @Route("/{id}/edit", name="parecer_edit", methods="GET|POST")
     * @ParamConverter("entity", class="App\Entity\Parecer")
     */
    public function edit(Request $request, IEntity $entity): Response
    {
        return parent::edit($request, $entity);
    }

    /**
     * @Route("/{id}", name="parecer_delete", methods="DELETE")
     * @ParamConverter("entity", class="App\Entity\Parecer")
     */
    public function delete(Request $request, IEntity $entity): Response
    {
        return parent::delete($request, $entity);
    }

    protected function getTemplateManager(): TemplateManager
    {
        $templateManager = parent::getTemplateManager();
        $templateManager->setNew('parecer/new.html.twig');
        $templateManager->setEdit('parecer/edit.html.twig');

        return $templateManager;
    }

    /**
     * @Route("/{id}/pdf", name="parecer_report_pdf", methods="GET")
     * @ParamConverter("entity", class="App\Entity\Parecer")
     */
    public function reportPdf(IEntity $entity, PdfGenerator $pdfGenerator): Response
    {
        $html = $this->renderView('parecer/report_pdf.html.twig', [
            'register' => $entity,
            'title' => 'Formulário Parecer',
        ]);

        $pdfGenerator->setStyle('report_pdf.css');
        $pdfGenerator->setContent($html);

        return $pdfGenerator->generate();
    }
}
