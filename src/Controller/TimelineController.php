<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 14/10/18
 * Time: 13:31
 */

namespace App\Controller;


use App\Entity\Comentario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TimelineController
 * @Route("/timeline")
 */
class TimelineController extends AbstractController
{

    /**
     * @Route("/", name="timeline_index")
     */
    public function index(){
        $repository = $this->getDoctrine()->getRepository(Comentario::class);
        $registers = $repository->findAll();
        return $this->render('others/_timeline.html.twig', ['registers' => $registers]);
    }
}