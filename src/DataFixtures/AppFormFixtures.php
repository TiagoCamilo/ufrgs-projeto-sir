<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 04/10/18
 * Time: 14:06.
 */

namespace App\DataFixtures;

use App\Entity\EntidadeDadoMapeado;
use App\Entity\Formulario;
use App\Entity\FormularioAgrupador;
use App\Entity\FormularioCampo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFormFixtures extends Fixture
{
    private $entidadeDadoList = [];

    public function load(ObjectManager $manager)
    {
        $this->createEntidadoDadoList($manager);
        $this->createFormularioPlanoDesenvolvimento($manager);
        $this->createFormularioAdequacaoCurricular($manager);
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

    private function newCampoEntity($label, $linha, $coluna, $formulario, $agrupador, EntidadeDadoMapeado $entidadeDadoMapeado)
    {
        return $this->newCampo($label, $linha, $coluna, $formulario, $agrupador, $entidadeDadoMapeado)->setTipo('EntityType');
    }

    private function newCampo($label, $linha, $coluna, $formulario, $agrupador, EntidadeDadoMapeado $entidadeDadoMapeado = null)
    {
        $campo = new FormularioCampo();
        $campo->setTipo('TextType');
        $campo->setLabel($label);
        $campo->setAgrupador($agrupador);
        $campo->setLinha($linha);
        $campo->setColuna($coluna);
        $campo->setEntidadeDadoMapeado($entidadeDadoMapeado);

        return $campo;
    }

    private function createFormularioAdequacaoCurricular(ObjectManager $manager)
    {
        $formulario = new Formulario();
        $formulario->setNome('Adequação Curricular');

        $agrupadorIdentificacao = new FormularioAgrupador();
        $agrupadorIdentificacao->setFormulario($formulario)->setTitulo('Identificação')->setOrdem(1);

        $agrupadorAdequcacao = new FormularioAgrupador();
        $agrupadorAdequcacao->setFormulario($formulario)->setTitulo('Adequação')->setOrdem(2);

        $agrupadorIdentificacao->addFormularioCampo($this->newCampoEntity('Nome', 1, 1, $formulario,
            $agrupadorIdentificacao, $this->entidadeDadoList['Aluno']['nome']));
        $agrupadorIdentificacao->addFormularioCampo($this->newCampoData('Data', 2, 1, $formulario, $agrupadorIdentificacao));
        $agrupadorIdentificacao->addFormularioCampo($this->newCampoEntity('Turma', 2, 2, $formulario,
            $agrupadorIdentificacao, $this->entidadeDadoList['Aluno']['turma']));
        $agrupadorIdentificacao->addFormularioCampo($this->newCampoText('Área', 2, 3, $formulario, $agrupadorIdentificacao));
        $agrupadorIdentificacao->addFormularioCampo($this->newCampoText('Professor', 2, 4, $formulario, $agrupadorIdentificacao));
        $agrupadorIdentificacao->addFormularioCampo($this->newCampoText('Trimeste', 2, 5, $formulario, $agrupadorIdentificacao));

        ///Modificado para EntityType em /src/Migrations/Version20191013142428.php
        $campoHistorico = $this->newCampoTextArea('Histórico', 1, 1, $formulario, $agrupadorAdequcacao);
        $campoHistorico->setAltura(21);
        $agrupadorAdequcacao->addFormularioCampo($campoHistorico);

        $campoNecessidade = $this->newCampoTextArea('Necessidade', 1, 2, $formulario, $agrupadorAdequcacao);
        $campoNecessidade->setAltura(21);
        $agrupadorAdequcacao->addFormularioCampo($campoNecessidade);

        $agrupadorAdequcacao->addFormularioCampo($this->newCampoLabel('Programação', 1, 3, $formulario, $agrupadorAdequcacao)->setOrdem(1));
        $agrupadorAdequcacao->addFormularioCampo($this->newCampoTextArea('1) Objetivos', 1, 3, $formulario, $agrupadorAdequcacao)->setOrdem(2));
        $agrupadorAdequcacao->addFormularioCampo($this->newCampoTextArea('2) Conteúdos Conceituais', 1, 3, $formulario, $agrupadorAdequcacao)->setOrdem(3));
        $agrupadorAdequcacao->addFormularioCampo($this->newCampoTextArea('3) Conteúdos Procedimentais e Avaliações', 1, 3, $formulario, $agrupadorAdequcacao)->setOrdem(4));

        $agrupadorAdequcacao->addFormularioCampo($this->newCampoLabel('Sugestão', 1, 4, $formulario, $agrupadorAdequcacao)->setOrdem(1));
        $agrupadorAdequcacao->addFormularioCampo($this->newCampoTextArea('1) Objetivos', 1, 4, $formulario, $agrupadorAdequcacao)->setOrdem(2));
        $agrupadorAdequcacao->addFormularioCampo($this->newCampoTextArea('2) Conteúdos Conceituais', 1, 4, $formulario, $agrupadorAdequcacao)->setOrdem(3));
        $agrupadorAdequcacao->addFormularioCampo($this->newCampoTextArea('3) Estratégias Procedimentais e Avaliações', 1, 4, $formulario, $agrupadorAdequcacao)->setOrdem(4));

        $manager->persist($agrupadorIdentificacao);
        $manager->persist($agrupadorAdequcacao);
        $manager->persist($formulario);
        $manager->flush();
    }

    private function createFormularioPlanoDesenvolvimento(ObjectManager $manager)
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

        $agrupadorIdentificacao->addFormularioCampo($this->newCampoEntity('Nome', 1, 1, $formulario,
            $agrupadorIdentificacao, $this->entidadeDadoList['Aluno']['nome']));
        $agrupadorIdentificacao->addFormularioCampo($this->newCampoEntity('Idade', 2, 1, $formulario,
            $agrupadorIdentificacao, $this->entidadeDadoList['Aluno']['getIdade']));
        $agrupadorIdentificacao->addFormularioCampo($this->newCampoEntity('Data Nascimento', 2, 2, $formulario,
            $agrupadorIdentificacao, $this->entidadeDadoList['Aluno']['dataNascimento']));
        $agrupadorIdentificacao->addFormularioCampo($this->newCampoEntity('Matrícula', 2, 3, $formulario,
            $agrupadorIdentificacao, $this->entidadeDadoList['Aluno']['matricula']));
        $agrupadorIdentificacao->addFormularioCampo($this->newCampoTextArea('Outras Informações', 3, 1, $formulario, $agrupadorIdentificacao));

        $agrupadorHistorico->addFormularioCampo($this->newCampoText('Encamihamento AEE', 1, 1, $formulario, $agrupadorHistorico));
        $agrupadorHistorico->addFormularioCampo($this->newCampoData('Data', 1, 2, $formulario, $agrupadorHistorico));
        $agrupadorHistorico->addFormularioCampo($this->newCampoText('Motivo Principal', 1, 3, $formulario, $agrupadorHistorico));
        $agrupadorHistorico->addFormularioCampo($this->newCampoTextArea('Dinâmica Familiar', 2, 1, $formulario, $agrupadorHistorico));

        ///Modificado para EntityType em /src/Migrations/Version20191013142428.php
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

    public function createEntidadoDadoList(ObjectManager $manager)
    {
        $this->entidadeDadoList['Aluno']['nome'] = new EntidadeDadoMapeado();
        $this->entidadeDadoList['Aluno']['dataNascimento'] = new EntidadeDadoMapeado();
        $this->entidadeDadoList['Aluno']['getIdade'] = new EntidadeDadoMapeado();
        $this->entidadeDadoList['Aluno']['matricula'] = new EntidadeDadoMapeado();
        $this->entidadeDadoList['Aluno']['turma'] = new EntidadeDadoMapeado();
        $this->entidadeDadoList['Aluno']['nomeMae'] = new EntidadeDadoMapeado();
        $this->entidadeDadoList['Aluno']['nomePai'] = new EntidadeDadoMapeado();
        $this->entidadeDadoList['Aluno']['historicoEscolar'] = new EntidadeDadoMapeado();
        $this->entidadeDadoList['Aluno']['escola'] = new EntidadeDadoMapeado();

        foreach ($this->entidadeDadoList as $entityName => $data) {
            foreach ($data as $dataName => $obj) {
                $obj->setEntidadeNome($entityName)->setEntidadeDado($dataName);
                $manager->persist($obj);
                $manager->flush();
            }
        }
    }
}
