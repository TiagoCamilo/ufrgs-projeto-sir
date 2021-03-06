<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 14/10/18
 * Time: 09:27.
 */

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\EntityInterface;
use App\Form\UsuarioEditType;
use App\Form\UsuarioType;
use App\Repository\UsuarioRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/usuario")
 */
class UsuarioController extends AbstractAppController
{
    private $passwordEncoder;

    public function __construct(UsuarioRepository $entityRepository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entity = new Usuario();
        $this->entityRepository = $entityRepository;
        $this->entityName = 'usuario';
        $this->formType = UsuarioType::class;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/{page}/page", name="usuario_index", methods="GET|POST", defaults={"page" = 1})
     * @IsGranted("usuario_list")
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        return parent::index($paginator, $request);
    }

    /**
     * @Route("/new", name="usuario_new", methods="GET|POST")
     * @IsGranted("usuario_new")
     */
    public function new(Request $request, UserInterface $user): Response
    {
        $form = $this->createForm($this->formType, $this->entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->passwordEncoder->encodePassword($this->entity, $this->entity->plainPassword);
            $this->entity->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($this->entity);
            $em->flush();

            return $this->newSuccessResponse($this->entity);
        }

        return $this->render($this->getTemplateManager()->getNew(), [
            'form' => $form->createView(),
            'entityName' => $this->entityName,
            'entityDisplayedName' => $this->entityDisplayedName,
            'template' => (array) $this->getTemplateManager(),
        ]);
    }

    /**
     * @Route("/{id}", name="usuario_show", methods="GET")
     * @ParamConverter("entity", class="App\Entity\Usuario")
     * @IsGranted("usuario_show", subject="entity")
     */
    public function show(EntityInterface $entity): Response
    {
        return parent::show($entity);
    }

    /**
     * @Route("/{id}/edit", name="usuario_edit", methods="GET|POST")
     * @ParamConverter("entity", class="App\Entity\Usuario")
     * @IsGranted("usuario_edit", subject="entity")
     */
    public function edit(Request $request, EntityInterface $entity): Response
    {
        if ($this->getUser()->isEducador() && $this->getUser() !== $entity) {
            return new Response('Acesso Negado', 403);
        }
        $this->formType = UsuarioEditType::class;

        return parent::edit($request, $entity);
    }

    protected function editSuccessResponse(EntityInterface $entity): Response
    {
        if ($this->getUser()->isEducador()) {
            return $this->redirectToRoute('home');
        }

        return $this->redirectToRoute("{$this->entityName}_index");
    }

    /**
     * @Route("/{id}", name="usuario_delete", methods="DELETE")
     * @ParamConverter("entity", class="App\Entity\Usuario")
     * @IsGranted("usuario_delete", subject="entity")
     */
    public function delete(Request $request, EntityInterface $entity): Response
    {
        return parent::delete($request, $entity);
    }
}
