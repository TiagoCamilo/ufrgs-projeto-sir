<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 04/10/18
 * Time: 14:06.
 */

namespace App\DataFixtures;

use App\Entity\Formulario;
use App\Entity\FormularioAgrupador;
use App\Entity\FormularioCampo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFormFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $formulario = new Formulario();
        $formulario->setNome('Plano de Desenvolvimento Individual');

        $agrupadorIdentificacao = new FormularioAgrupador();
        $agrupadorIdentificacao->setFormulario($formulario)->setTitulo('Identificação')->setOrdem(1);

        $agrupadorHistorico = new FormularioAgrupador();
        $agrupadorHistorico->setFormulario($formulario)->setTitulo('Histórico')->setOrdem(2);

        $agrupadorAnacronismos = new FormularioAgrupador();
        $agrupadorAnacronismos->setFormulario($formulario)->setTitulo('Anacronismos e Habilidades')->setOrdem(3);

        $agrupadorIntervencoes = new FormularioAgrupador();
        $agrupadorIntervencoes->setFormulario($formulario)->setTitulo('Plano de Intervenção Pedagógica')->setOrdem(4);

        $agrupadorIdentificacao->addFormularioCampo($this->newCampoText('Idade', 1, 1, $formulario, $agrupadorIdentificacao));
        $agrupadorIdentificacao->addFormularioCampo($this->newCampoData('Data Nascimento', 1, 2, $formulario, $agrupadorIdentificacao));
        $agrupadorIdentificacao->addFormularioCampo($this->newCampoText('Matrícula', 1, 3, $formulario, $agrupadorIdentificacao));
        $agrupadorIdentificacao->addFormularioCampo($this->newCampoTextArea('Outras Informações', 2, 1, $formulario, $agrupadorIdentificacao));

        $agrupadorHistorico->addFormularioCampo($this->newCampoText('Encamihamento AEE', 1, 1, $formulario, $agrupadorHistorico));
        $agrupadorHistorico->addFormularioCampo($this->newCampoData('Data', 1, 2, $formulario, $agrupadorHistorico));
        $agrupadorHistorico->addFormularioCampo($this->newCampoText('Motivo Principal', 1, 3, $formulario, $agrupadorHistorico));
        $agrupadorHistorico->addFormularioCampo($this->newCampoTextArea('Dinâmica Familiar', 2, 1, $formulario, $agrupadorHistorico));
        $agrupadorHistorico->addFormularioCampo($this->newCampoTextArea('Histórico Escolar', 2, 2, $formulario, $agrupadorHistorico));
        $agrupadorHistorico->addFormularioCampo($this->newCampoTextArea('Atendimento(especializados)', 3, 1, $formulario, $agrupadorHistorico));
        $agrupadorHistorico->addFormularioCampo($this->newCampoTextArea('NEES', 3, 2, $formulario, $agrupadorHistorico));

        $agrupadorAnacronismos->addFormularioCampo($this->newCampoLabel('Funções Cognitiva', 1, 1, $formulario, $agrupadorAnacronismos));
        $agrupadorAnacronismos->addFormularioCampo($this->newCampoLabel('Funções Interativas Sociais', 1, 2, $formulario, $agrupadorAnacronismos));
        $agrupadorAnacronismos->addFormularioCampo($this->newCampoLabel('Funções Motoras', 1, 3, $formulario, $agrupadorAnacronismos));
        $agrupadorAnacronismos->addFormularioCampo($this->newCampoTextArea('Memória(Curto/Longo Prazo)', 2, 1, $formulario, $agrupadorAnacronismos));
        $agrupadorAnacronismos->addFormularioCampo($this->newCampoTextArea('Relações Interpessoais', 2, 2, $formulario, $agrupadorAnacronismos));
        $agrupadorAnacronismos->addFormularioCampo($this->newCampoTextArea('Dinâmica Geral - Controle de ações motoras', 2, 3, $formulario, $agrupadorAnacronismos));
        $agrupadorAnacronismos->addFormularioCampo($this->newCampoTextArea('Raciocínio Lógico', 3, 1, $formulario, $agrupadorAnacronismos));
        $agrupadorAnacronismos->addFormularioCampo($this->newCampoTextArea('Relações Comportamentais', 3, 2, $formulario, $agrupadorAnacronismos));
        $agrupadorAnacronismos->addFormularioCampo($this->newCampoTextArea('Execução e intecionalidade', 3, 3, $formulario, $agrupadorAnacronismos));

        $agrupadorIntervencoes->addFormularioCampo($this->newCampoTextArea('Ações já existentes', 1, 1, $formulario, $agrupadorIntervencoes));
        $agrupadorIntervencoes->addFormularioCampo($this->newCampoTextArea('Ações a serem desenvolvidas', 2, 1, $formulario, $agrupadorIntervencoes));


        $manager->persist($agrupadorIdentificacao);
        $manager->persist($agrupadorHistorico);
        $manager->persist($agrupadorAnacronismos);
        $manager->persist($agrupadorIntervencoes);
        $manager->persist($formulario);
        $manager->flush();
    }

    private function newCampoText($label, $linha, $coluna, $formulario, $agrupador)
    {
        return $this->newCampo($label, $linha, $coluna, $formulario, $agrupador)->setTipo('TextType');
    }

    private function newCampoTextArea($label, $linha, $coluna, $formulario, $agrupador)
    {
        return $this->newCampo($label, $linha, $coluna, $formulario, $agrupador)->setTipo('TextareaType');
    }

    private function newCampoData($label, $linha, $coluna, $formulario, $agrupador)
    {
        return $this->newCampo($label, $linha, $coluna, $formulario, $agrupador)->setTipo('DateType');
    }

    private function newCampoLabel($label, $linha, $coluna, $formulario, $agrupador)
    {
        return $this->newCampo($label, $linha, $coluna, $formulario, $agrupador)->setTipo('LabelType');
    }

    private function newCampo($label, $linha, $coluna, $formulario, $agrupador)
    {
        $campo = new FormularioCampo();
        $campo->setTipo('TextType');
        $campo->setLabel($label);
        $campo->setFormulario($formulario);
        $campo->setAgrupador($agrupador);
        $campo->setLinha($linha);
        $campo->setColuna($coluna);

        return $campo;
    }
}
