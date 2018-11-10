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
use Knp\Component\Pager\PaginatorInterface;
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
    public function __construct(EscolaRepository $entityRepository)
    {
        $this->entity = new Escola();
        $this->entityRepository = $entityRepository;
        $this->entityName = 'escola';
        $this->formType = EscolaType::class;
    }

    /**
     * @Route("/{page}/page", name="escola_index", methods="GET|POST", defaults={"page" = 1})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        return parent::index($paginator, $request);
    }

    /**
     * @Route("/new", name="escola_new", methods="GET|POST")
     */
    public function new(Request $request, UserInterface $user): Response
    {
        return parent::new($request, $user);
    }

    /**
     * @Route("/{id}", name="escola_show", methods="GET")
     * @ParamConverter("entity", class="App\Entity\Escola")
     */
    public function show(IEntity $entity): Response
    {
        return parent::show($entity);
    }

    /**
     * @Route("/{id}/edit", name="escola_edit", methods="GET|POST")
     * @ParamConverter("entity", class="App\Entity\Escola")
     */
    public function edit(Request $request, IEntity $entity): Response
    {
        return parent::edit($request, $entity);
    }

    /**
     * @Route("/{id}", name="escola_delete", methods="DELETE")
     * @ParamConverter("entity", class="App\Entity\Escola")
     */
    public function delete(Request $request, IEntity $entity): Response
    {
        return parent::delete($request, $entity);
    }
}
