<?php

namespace App\Twig;

use App\Entity\Acompanhamento;
use App\Entity\Comentario;
use App\Entity\IEntity;
use Twig\Extension\AbstractExtension;
use Twig\TwigTest;


class InstanceOfExtension extends AbstractExtension
{
    public function getTests()
    {
        return [
            new TwigTest('Acompanhamento', function (IEntity $entity) { return $entity instanceof Acompanhamento; }),
            new TwigTest('Comentario', function (IEntity $entity) { return $entity instanceof Comentario; }),
        ];
    }
}
