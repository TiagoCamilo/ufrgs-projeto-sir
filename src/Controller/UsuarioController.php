<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 14/10/18
 * Time: 09:27.
 */

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\IEntity;
use App\Form\UsuarioType;
use App\Repository\UsuarioRepository;
use App\Service\FormularioModelo;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/usuario")
 */
class UsuarioController extends AppAbstractController
{

    public function __construct(UsuarioRepository $entityRepository, FormularioModelo $formularioModelo)
    {
        $this->entity = new Usuario();
        $this->entityRepository = $entityRepository;
        $this->entityName = 'usuario';
        $this->formType = UsuarioType::class;
    }

    /**
     * @Route("/{page}/page", name="usuario_index", methods="GET|POST", defaults={"page" = 1})
     * @IsGranted("aluno_list")
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        return parent::index($paginator, $request);
    }

    /**
     * @Route("/new", name="usuario_new", methods="GET|POST")
     * @IsGranted("aluno_new")
     */
    public function new(Request $request, UserInterface $user): Response
    {
        return parent::new($request, $user);
    }

    /**
     * @Route("/{id}", name="usuario_show", methods="GET")
     * @ParamConverter("entity", class="App\Entity\Usuario")
     * @IsGranted("aluno_show", subject="entity")
     */
    public function show(IEntity $entity): Response
    {
        return parent::show($entity);
    }

    /**
     * @Route("/{id}/edit", name="usuario_edit", methods="GET|POST")
     * @ParamConverter("entity", class="App\Entity\Usuario")
     * @IsGranted("aluno_edit", subject="entity")
     */
    public function edit(Request $request, IEntity $entity): Response
    {
        return parent::edit($request, $entity);
    }

    /**
     * @Route("/{id}", name="usuario_delete", methods="DELETE")
     * @ParamConverter("entity", class="App\Entity\Usuario")
     * @IsGranted("aluno_delete", subject="entity")
     */
    public function delete(Request $request, IEntity $entity): Response
    {
        return parent::delete($request, $entity);
    }
}
