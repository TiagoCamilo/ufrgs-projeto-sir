<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 25/09/18
 * Time: 13:12
 */

namespace App\Controller;


use App\Entity\Aluno;
use App\Form\AlunoType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AlunoController extends AbstractController
{

    /**
     * @Route("aluno/new")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
        $aluno = new Aluno();
        $aluno->setNome("Tiago Camilo");

        $form = $this->createForm(AlunoType::class,$aluno);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $aluno = $form->getData();
            dump($aluno);
            die();


            return $this->redirectToRoute('home');
        }

        return $this->render('aluno/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}