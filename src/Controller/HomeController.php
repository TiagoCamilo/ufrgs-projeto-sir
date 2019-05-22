<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 18/11/18
 * Time: 17:29.
 */

namespace App\Controller;

use App\Repository\AlunoRepository;
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
     */
    public function index(AlunoRepository $repository)
    {
        dump($this->session);
        $this->session->remove('aluno_id');
        $this->session->remove('aluno_nome');
        dump($this->session);

        return $this->render('home/index.html.twig', [
            'registers' => $repository->findAll(),
        ]);
    }
}
