<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 24/09/18
 * Time: 14:30
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    /**
     * @Route("/")
     */
    public function index(){
        return new Response('Teste!');
    }


    /**
     * @Route("timeline/{id}")
     */
    public function show($id)
    {
        return new Response("Timeline do aluno {$id}");
    }
}