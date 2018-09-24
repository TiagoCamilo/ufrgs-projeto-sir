<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 24/09/18
 * Time: 14:30
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class TimelineController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(){
        return new Response('Teste!');
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