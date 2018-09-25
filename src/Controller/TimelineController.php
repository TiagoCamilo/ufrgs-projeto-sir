<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 24/09/18
 * Time: 14:30
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TimelineController extends AbstractController
{
    /**
     * @Route("/",name="home")
     */
    public function index(){
        return $this->render('base.html.twig');
    }


    /**
     * @Route("show/{id}")
     */
    public function show($id)
    {
        return $this->render('timeline/show.html.twig',[
            'aluno_id' => $id
        ]);
    }
}