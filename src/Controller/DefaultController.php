<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 24/09/18
 * Time: 14:30.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function index()
    {
        return $this->render('base.html.twig');
    }
}
