<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 18/11/18
 * Time: 17:29.
 */

namespace App\Controller;

use App\Repository\AlunoRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $session;

    /**
     * HomeController constructor.
     *
     * @param $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/",name="home")
     * @IsGranted("aluno_show")
     */
    public function index(AlunoRepository $repository)
    {
        $this->session->remove('aluno_id');
        $this->session->remove('aluno_nome');

        return $this->render('home/index.html.twig', [
            'registers' => $repository->findAllByUserContext($this->getUser()),
        ]);
    }
}
