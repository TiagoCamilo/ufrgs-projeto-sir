<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 25/09/18
 * Time: 13:05
 */

namespace App\Entity;


class Aluno
{
    /**
     * @Assert\Type("string")
     */
    private $nome;

    /**
     * @Assert\Type("integer")
     */
    private $idade;

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getIdade()
    {
        return $this->idade;
    }

    /**
     * @param mixed $idade
     */
    public function setIdade($idade): void
    {
        $this->idade = $idade;
    }





}