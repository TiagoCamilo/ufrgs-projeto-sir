<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 14/10/18
 * Time: 09:27.
 */

namespace App\Controller;

use App\Entity\Escola;
use App\Entity\IEntity;
use App\Form\EscolaType;
use App\Repository\EscolaRepository;
use App\Service\FormularioModelo;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/escola")
 */
class EscolaController extends AppAbstractController
{
    private $formularioModelo;

    public function __construct(EscolaRepository $entityRepository, FormularioModelo $formularioModelo)
    {
        $this->entity = new Escola();
        $this->entityRepository = $entityRepository;
        $this->entityName = 'escola';
        $this->formType = EscolaType::class;
        $this->formularioModelo = $formularioModelo;
    }

    /**
     * @Route("/{page}/page", name="escola_index", methods="GET|POST", defaults={"page" = 1})
     * @IsGranted("escola_list")
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        return parent::index($paginator, $request);
    }

    /**
     * @Route("/new", name="escola_new", methods="GET|POST")
     * @IsGranted("escola_new")
     */
    public function new(Request $request, UserInterface $user): Response
    {
        $retorno = parent::new($request, $user);
        if (null !== $this->entity->getId()) { // Criando escola
            $this->formularioModelo->createFormModels($this->entity); // Clona formularios modelos
        }

        return $retorno;
    }

    /**
     * @Route("/{id}", name="escola_show", methods="GET")
     * @ParamConverter("entity", class="App\Entity\Escola")
     * @IsGranted("escola_show", subject="entity")
     */
    public function show(IEntity $entity): Response
    {
        return parent::show($entity);
    }

    /**
     * @Route("/{id}/edit", name="escola_edit", methods="GET|POST")
     * @ParamConverter("entity", class="App\Entity\Escola")
     * @IsGranted("escola_edit", subject="entity")
     */
    public function edit(Request $request, IEntity $entity): Response
    {
        return parent::edit($request, $entity);
    }

    /**
     * @Route("/{id}", name="escola_delete", methods="DELETE")
     * @ParamConverter("entity", class="App\Entity\Escola")
     * @IsGranted("escola_delete", subject="entity")
     */
    public function delete(Request $request, IEntity $entity): Response
    {
        return parent::delete($request, $entity);
    }
}
