<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class FilterExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('fill', [$this, 'fill']),
        ];
    }

    public function fill($input, $pad_length, $pad_string)
    {
        return str_pad($input, $pad_length, $pad_string);
    }
}
