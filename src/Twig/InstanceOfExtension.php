<?php

namespace App\Twig;

use App\Entity\Acompanhamento;
use App\Entity\Comentario;
use App\Entity\FormularioRegistro;
use App\Entity\IEntity;
use App\Entity\Parecer;
use Twig\Extension\AbstractExtension;
use Twig\TwigTest;

class InstanceOfExtension extends AbstractExtension
{
    public function getTests()
    {
        return [
            new TwigTest('Comentario', function (IEntity $entity) { return $entity instanceof Comentario; }),
            new TwigTest('Acompanhamento', function (IEntity $entity) { return $entity instanceof Acompanhamento; }),
            new TwigTest('Parecer', function (IEntity $entity) { return $entity instanceof Parecer; }),
            new TwigTest('Formulario', function (IEntity $entity) { return $entity instanceof FormularioRegistro; }),
        ];
    }
}
