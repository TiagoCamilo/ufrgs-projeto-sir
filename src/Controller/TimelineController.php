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
     * @Route("/{entityOpenner}", name="timeline_index", defaults={"entityOpenner"=""})
     */
    public function index(string $entityOpenner): Response
    {

        $timeline_element = 'all';

        switch ($timeline_element) {
            case 'all':
                $timelineElements = $this->aluno->getTimelineElements();
                break;
            case 'midia':
                $timelineElements = $this->aluno->getComentarios();
                break;
            case 'acompanhamento':
                $timelineElements = $this->aluno->getAcompanhamentos();
                break;
            case 'parecer':
                $timelineElements = $this->aluno->getPareceres();
                break;
            default:
                $timelineElements = $this->aluno->getTimelineElements();
        }

        return $this->render('timeline/index.html.twig', [
            'entityOpenner' => $entityOpenner,
            'register' => $this->aluno,
            'timelineElements' => $timelineElements,
        ]);
    }

}
