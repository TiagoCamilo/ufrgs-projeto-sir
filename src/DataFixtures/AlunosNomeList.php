<?php

namespace App\DataFixtures;

class AlunosNomeList
{
    public static $list =
        ['Sophia',
            'Alice',
            'Julia',
            'Isabella',
            'Manuela',
            'Laura',
            'Luiza',
            'Valentina',
            'Giovanna',
            'Maria Eduarda',
            'Helena',
            'Beatriz',
            'Maria Luiza',
            'Lara',
            'Mariana',
            'Nicole',
            'Rafaela',
            'Heloísa',
            'Isadora',
            'Lívia',
            'Maria Clara',
            'Ana Clara',
            'Lorena',
            'Gabriela',
            'Yasmin',
            'Isabelly',
            'Sarah',
            'Ana Julia',
            'Letícia',
            'Ana Luiza',
            'Melissa',
            'Marina',
            'Clara',
            'Cecília',
            'Esther',
            'Emanuelly',
            'Rebeca',
            'Ana Beatriz',
            'Lavínia',
            'Vitória',
            'Bianca',
            'Catarina',
            'Larissa',
            'Maria Fernanda',
            'Fernanda',
            'Amanda',
            'Alícia',
            'Carolina',
            'Agatha',
            'Gabrielly',
            'Miguel',
            'Davi',
            'Arthur',
            'Pedro',
            'Gabriel',
            'Bernardo',
            'Lucas',
            'Matheus',
            'Rafael',
            'Heitor',
            'Enzo',
            'Guilherme',
            'Nicolas',
            'Lorenzo',
            'Gustavo',
            'Felipe',
            'Samuel',
            'João Pedro',
            'Daniel',
            'Vitor',
            'Leonardo',
            'Henrique',
            'Theo',
            'Murilo',
            'Eduardo',
            'Pedro Henrique',
            'Pietro',
            'Cauã',
            'Isaac',
            'Caio',
            'Vinicius',
            'Benjamin',
            'João',
            'Lucca',
            'João Miguel',
            'Bryan',
            'Joaquim',
            'João Vitor',
            'Thiago',
            'Antônio',
            'Davi Lucas',
            'Francisco',
            'Enzo Gabriel',
            'Bruno',
            'Emanuel',
            'João Gabriel',
            'Ian',
            'Davi Luiz',
            'Rodrigo',
            'Otávio',
        ];

    public static function getRandomItem()
    {
        $randIndex = array_rand(AlunosNomeList::$list);

        return AlunosNomeList::$list[$randIndex];
    }
}