<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 14/10/18
 * Time: 13:31.
 */

namespace App\Controller;

use App\Repository\AlunoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TimelineController.
 *
 * @Route("/timeline")
 */
class TimelineController extends AbstractController
{
    private $aluno;

    public function __construct(SessionInterface $session, AlunoRepository $alunoRepository)
    {
        if (null !== $session->get('aluno_id')) {
            $this->aluno = $alunoRepository->find($session->get('aluno_id'));
        }
    }

    /**
     * @Route("/{entityOpenner}/{orientation}", name="timeline_index", defaults={"entityOpenner"="","orientation"="horizontal"})
     */
    public function index(string $entityOpenner, string $orientation): Response
    {
        return $this->render('timeline/index.html.twig', [
            'entityOpenner' => $entityOpenner,
            'register' => $this->aluno,
            'timelineElements' => $this->aluno->getTimelineElements(),
            'orientation' => $orientation,
        ]);
    }
}
