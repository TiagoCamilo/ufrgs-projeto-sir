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
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/",name="home")
     */
    public function index(AlunoRepository $repository)
    {
        return $this->render('home/index.html.twig', [
            'registers' => $repository->findAll(),
        ]);
    }
}
