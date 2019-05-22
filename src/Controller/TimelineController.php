<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 14/10/18
 * Time: 13:31.
 */

namespace App\Controller;

use App\Repository\AlunoRepository;
use App\Repository\ComentarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/", name="timeline_index")
     */
    public function index()
    {
        $registers = $this->aluno->getComentarios();

        return $this->render('others/_timeline.html.twig', ['registers' => $registers]);
    }
}
