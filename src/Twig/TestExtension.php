<?php

namespace App\Twig;

use App\Entity\Acompanhamento;
use App\Entity\Comentario;
use App\Entity\FormularioRegistro;
use App\Entity\EntityInterface;
use App\Entity\Parecer;
use Twig\Extension\AbstractExtension;
use Twig\TwigTest;

class TestExtension extends AbstractExtension
{
    public function getTests()
    {
        return [
            new TwigTest('Comentario', function (EntityInterface $entity) { return $entity instanceof Comentario; }),
            new TwigTest('Acompanhamento', function (EntityInterface $entity) { return $entity instanceof Acompanhamento; }),
            new TwigTest('Parecer', function (EntityInterface $entity) { return $entity instanceof Parecer; }),
            new TwigTest('Formulario', function (EntityInterface $entity) { return $entity instanceof FormularioRegistro; }),
        ];
    }
}
