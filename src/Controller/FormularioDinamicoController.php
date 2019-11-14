<?php

namespace App\Controller;

use App\Entity\Formulario;
use App\Entity\FormularioRegistro;
use App\Entity\FormularioRegistroCampo;
use App\Entity\IEntity;
use App\Form\FormularioDinamicoType;
use App\Helpers\TemplateManager;
use App\Repository\AlunoRepository;
use App\Repository\FormularioRegistroRepository;
use App\Repository\FormularioRepository;
use App\Service\PdfGenerator;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/formulario_dinamico/{form_id}", defaults={"form_id" = 1})
 */
class FormularioDinamicoController extends AbstractController
{
    protected $entity;
    protected $entityRepository;
    protected $entityName;
    protected $entityDisplayedName = null;
    protected $formType;
    private $aluno;

    public function __construct(FormularioRegistroRepository $entityRepository, SessionInterface $session, AlunoRepository $alunoRepository)
    {
        $this->entity = new FormularioRegistro();
        $this->entityRepository = $entityRepository;
        $this->entityName = 'formulario_dinamico';
        $this->entityDisplayedName = 'Formulário';
        $this->formType = FormularioDinamicoType::class;

        if (null !== $session->get('aluno_id')) {
            $this->aluno = $alunoRepository->find($session->get('aluno_id'));
        }
    }

    /**
     * @Route("/", name="formulario_dinamico_index", methods="GET|POST", defaults={"page" = 1})
     * @IsGranted("formulario_list")
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $resultSet = $paginator->paginate(
            $this->entityRepository->findByUserContext($this->getUser(), ['formulario' => $request->get('form_id')]),
            $request->get('page')
        );

        //TODO: Refatorar para obter o response em cada metodo
        return $this->render("{$this->entityName}/index.html.twig", [
            'registers' => $resultSet,
            'entityName' => $this->entityName,
            'template' => (array) $this->getTemplateManager(),
            'formId' => $request->get('form_id'),
        ]);
    }

    /**
     * @Route("/new", name="formulario_dinamico_new", methods={"GET","POST"})
     * @IsGranted("formulario_new")
     */
    public function new(Request $request, FormularioRepository $formularioRepository, UserInterface $user): Response
    {
        $formularioModelo = $formularioRepository->find($request->get('form_id'));

        $formularioRegistro = new FormularioRegistro();

        if ($request->isMethod('POST')) {
            foreach ($formularioModelo->getFormularioAgrupadores() as $agrupador) {
                foreach ($agrupador->getFormularioCampos() as $campoModelo) {
                    $campoRegistro = new FormularioRegistroCampo();

                    $campoRegistro->setFormularioCampo($campoModelo);
                    $valor = $request->request->get($campoModelo->getId());
                    $campoRegistro->setValor($valor);

                    $formularioRegistro->addFormularioRegistroCampo($campoRegistro);
                }
            }

            $formularioRegistro->setUsuario($user);
            $formularioRegistro->setAluno($this->aluno);
            $formularioRegistro->setFormulario($formularioModelo);
            $formularioRegistro->setDataHora(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($formularioRegistro);
            $em->flush();

            //return $this->redirectToRoute("{$this->entityName}_index", ['form_id' => $request->get('form_id')]);
            return $this->redirectToRoute('perfil_aluno_profile', [
                'id' => $this->aluno->getId(),
            ]);
        }

        return $this->render($this->getTemplateManager()->getNew(), [
            'formulario' => $formularioModelo,
            'entityName' => $this->entityName,
            'entityDisplayedName' => $this->entityDisplayedName,
            'template' => (array) $this->getTemplateManager(),
            'formId' => $request->get('form_id'),
        ]);
    }

    /**
     * @Route("/{id}", name="formulario_dinamico_show", methods={"GET"})
     * @ParamConverter("entity", class="App\Entity\FormularioRegistro")
     * @IsGranted("formulario_show", subject="entity")
     */
    public function show(Request $request, IEntity $entity, PdfGenerator $pdfGenerator, FormularioRepository $formularioRepository): Response
    {
        $formularioModelo = $formularioRepository->find($request->get('form_id'));

        $html = $this->render('formulario_dinamico/report_pdf.twig', [
            'formulario' => $formularioModelo,
            'formularioRegistro' => $entity,
            'title' => $formularioModelo->getNome(),
        ]);

        return $html;
    }

    /**
     * @Route("/{id}/edit", name="formulario_dinamico_edit", methods={"GET","POST"})
     * @IsGranted("formulario_edit", subject="formularioRegistro")
     */
    public function edit(Request $request, FormularioRepository $formularioRepository, FormularioRegistro $formularioRegistro, UserInterface $user): Response
    {
        $formularioModelo = $formularioRepository->find($request->get('form_id'));

        if ($request->isMethod('POST')) {
            foreach ($formularioModelo->getFormularioAgrupadores() as $agrupador) {
                foreach ($agrupador->getFormularioCampos() as $campoModelo) {
                    // Verifica se já existe valor salvo
                    $campoRegistroSalvo = $formularioRegistro->getFormularioRegistroCampos()->filter(
                        function ($element) use ($campoModelo) {
                            return $element->getFormularioCampo()->getId() == $campoModelo->getId();
                        });

                    if (count($campoRegistroSalvo)) {
                        $campoRegistro = $campoRegistroSalvo->current();
                    } else {
                        $campoRegistro = new FormularioRegistroCampo();
                    }

                    $campoRegistro->setFormularioCampo($campoModelo);
                    $valor = $request->request->get($campoModelo->getId());
                    $campoRegistro->setValor($valor);

                    $formularioRegistro->addFormularioRegistroCampo($campoRegistro);
                }
            }

            $formularioRegistro->setUsuario($user);
            $formularioRegistro->setAluno($this->aluno);
            $formularioRegistro->setDataHora(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($formularioRegistro);
            $em->flush();

            //return $this->redirectToRoute("{$this->entityName}_index", ['form_id' => $request->get('form_id')]);
            return $this->redirectToRoute('perfil_aluno_profile', [
                'id' => $this->aluno->getId(),
            ]);
        }

        return $this->render($this->getTemplateManager()->getEdit(), [
            'formulario' => $formularioModelo,
            'formularioRegistro' => $formularioRegistro,
            'entityName' => $this->entityName,
            'template' => (array) $this->getTemplateManager(),
            'formId' => $request->get('form_id'),
        ]);
    }

    /**
     * @Route("/{id}", name="formulario_dinamico_delete", methods={"DELETE"})
     * @IsGranted("formulario_delete", subject="formularioRegistro")
     */
    public function delete(Request $request, FormularioRegistro $formularioRegistro): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formularioRegistro->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formularioRegistro);
            $entityManager->flush();
        }

        //Sempre que houver aluno "em sessao", volta para o perfil do mesmo
        if (null !== $this->aluno->getId()) {
            return $this->redirectToRoute('perfil_aluno_profile', [
                'id' => $this->aluno->getId(),
            ]);
        }

        return $this->redirectToRoute('formulario_dinamico_index', ['form_id' => $request->get('form_id')]);
    }

    /**
     * @Route("/{id}/pdf", name="formulario_dinamico_report_pdf", methods="GET")
     * @ParamConverter("entity", class="App\Entity\FormularioRegistro")
     * @IsGranted("formulario_show", subject="entity")
     */
    public function reportPdf(Request $request, IEntity $entity, PdfGenerator $pdfGenerator, FormularioRepository $formularioRepository): Response
    {
        $formularioModelo = $formularioRepository->find($request->get('form_id'));

        $html = $this->renderView('formulario_dinamico/report_pdf.twig', [
            'formulario' => $formularioModelo,
            'formularioRegistro' => $entity,
            'title' => $formularioModelo->getNome(),
        ]);

        $pdfGenerator->setStyle('report_pdf.css');
        $pdfGenerator->setContent($html);

        return $pdfGenerator->generate();
    }

    private function getTemplateManager(): TemplateManager
    {
        $templateManager = new TemplateManager();
        $templateManager->setEdit('generic/edit.html.twig');
        $templateManager->setNew('generic/new.html.twig');
        $templateManager->setForm('formulario_dinamico/_form.html.twig');
        $templateManager->setDelete('formulario_dinamico/_delete_form.html.twig');
        $templateManager->setIndexActions('formulario_dinamico/_index_registers.html.twig');
        $templateManager->setIndexFooter('formulario_dinamico/_index_footer.html.twig');
        $templateManager->setShowActions('generic/_show_actions.html.twig');

        return $templateManager;
    }
}
