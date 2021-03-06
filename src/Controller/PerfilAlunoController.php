<?php

namespace App\Controller;

use App\Entity\Aluno;
use App\Entity\EntityInterface;
use App\Form\AlunoType;
use App\Repository\AlunoRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/perfil_aluno")
 */
class PerfilAlunoController extends AbstractAppController
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
     * @Route("/{id}/{timeline_element}", name="perfil_aluno_profile", methods="GET", defaults={"timeline_element"="all"}))
     * @ParamConverter("entity", class="App\Entity\Aluno")
     * @IsGranted("aluno_show", subject="entity")
     */
    public function profile(EntityInterface $entity, string $timeline_element): Response
    {
        $this->session->set('aluno_id', $entity->getId());
        $this->session->set('aluno_nome', $entity->getPrimeiroNome());

        return $this->render("{$this->entityName}/show.html.twig", [
            'register' => $entity,
        ]);
    }
}
