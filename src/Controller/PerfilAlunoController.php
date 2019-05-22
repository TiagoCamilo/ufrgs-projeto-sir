<?php

namespace App\Controller;

use App\Entity\Aluno;
use App\Entity\IEntity;
use App\Form\AlunoType;
use App\Repository\AlunoRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/perfil_aluno")
 */
class PerfilAlunoController extends AppAbstractController
{
    private $session;

    public function __construct(AlunoRepository $entityRepository, SessionInterface $session)
    {
        $this->entity = new Aluno();
        $this->entityRepository = $entityRepository;
        $this->entityName = 'perfil_aluno';
        $this->formType = AlunoType::class;
        $this->session = $session;
    }

    /**
     * @Route("/{id}", name="perfil_aluno_show", methods="GET")
     * @ParamConverter("entity", class="App\Entity\Aluno")
     */
    public function show(IEntity $entity): Response
    {
        $this->session->set('aluno_id', $entity->getId());
        $this->session->set('aluno_nome', $entity->getNome());

        return $this->render("{$this->entityName}/show.html.twig", [
            'register' => $entity,
            'entityName' => $this->entityName,
            'template' => (array) $this->getTemplateManager(),
        ]);
    }
}
