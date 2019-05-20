<?php

namespace App\Controller;

use App\Entity\Formulario;
use App\Entity\FormularioRegistro;
use App\Entity\FormularioRegistroCampo;
use App\Entity\IEntity;
use App\Form\FormularioDinamicoType;
use App\Helpers\TemplateManager;
use App\Repository\FormularioRegistroRepository;
use App\Repository\FormularioRepository;
use App\Service\PdfGenerator;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/formulario_dinamico/{form_id}", defaults={"form_id" = 1})
 */
class FormularioDinamicoController extends AbstractController
{
    protected $entity;
    protected $entityRepository;
    protected $entityName;
    protected $formType;

    public function __construct(FormularioRegistroRepository $entityRepository)
    {
        $this->entity = new FormularioRegistro();
        $this->entityRepository = $entityRepository;
        $this->entityName = 'formulario_dinamico';
        $this->formType = FormularioDinamicoType::class;
    }

    /**
     * @Route("/", name="formulario_dinamico_index", methods="GET|POST", defaults={"page" = 1})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $resultSet = $paginator->paginate(
            $this->entityRepository->findBy(['formulario' => $request->get('form_id')]),
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
     */
    public function new(Request $request, FormularioRepository $formularioRepository): Response
    {
        //TODO: Receber como param o identificador do modelo de formuario
        $formularioModelo = $formularioRepository->find($request->get('form_id'));

        $formularioRegistro = new FormularioRegistro();

        if ($request->isMethod('POST')) {
            foreach ($formularioModelo->getFormularioCampos() as $campoModelo) {
                $campoRegistro = new FormularioRegistroCampo();

                $campoRegistro->setFormularioCampo($campoModelo);
                $valor = $request->request->get($campoModelo->getId());
                $campoRegistro->setValor($valor);

                $formularioRegistro->addFormularioRegistroCampo($campoRegistro);
            }

            $formularioRegistro->setFormulario($formularioModelo);
            $formularioRegistro->setDataHora(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($formularioRegistro);
            $em->flush();

            return $this->redirectToRoute("{$this->entityName}_index");
        }

        return $this->render($this->getTemplateManager()->getNew(), [
            'formulario' => $formularioModelo,
            'entityName' => $this->entityName,
            'template' => (array) $this->getTemplateManager(),
            'formId' => $request->get('form_id'),

        ]);
    }

    /**
     * @Route("/{id}", name="formulario_dinamico_show", methods={"GET"})
     * @ParamConverter("entity", class="App\Entity\FormularioRegistro")
     */
    public function show(IEntity $entity): Response
    {
        return $this->render('formulario_dinamico/show.html.twig', [
            'register' => $entity,
            'entityName' => $this->entityName,
            'template' => (array) $this->getTemplateManager(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="formulario_dinamico_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FormularioRepository $formularioRepository, FormularioRegistro $formularioRegistro): Response
    {
        $formularioModelo = $formularioRepository->find(1);

        if ($request->isMethod('POST')) {
            foreach ($formularioModelo->getFormularioCampos() as $campoModelo) {
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

            $formularioRegistro->setDataHora(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($formularioRegistro);
            $em->flush();

            return $this->redirectToRoute("{$this->entityName}_index", ['id' => $formularioRegistro->getId()]);
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
     */
    public function delete(Request $request, FormularioRegistro $formularioRegistro): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formularioRegistro->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formularioRegistro);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formulario_dinamico_index');
    }

    /**
     * @Route("/{id}/pdf", name="formulario_dinamico_report_pdf", methods="GET")
     * @ParamConverter("entity", class="App\Entity\FormularioRegistro")
     */
    public function reportPdf(IEntity $entity, PdfGenerator $pdfGenerator, FormularioRepository $formularioRepository): Response
    {
        $formularioModelo = $formularioRepository->find(1);

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
        $templateManager->setDelete('generic/_delete_form.html.twig');
        $templateManager->setIndexActions('generic/_index_registers.html.twig');
        $templateManager->setIndexFooter('formulario_dinamico/_index_footer.html.twig');
        $templateManager->setShowActions('generic/_show_actions.html.twig');

        return $templateManager;
    }
}
