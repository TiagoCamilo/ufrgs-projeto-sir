<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 08/10/18
 * Time: 11:25
 */

namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AlunoControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * @dataProvider provideUrls
     */
    public function testPageIsSuccessful($url)
    {
        $this->client->request('GET', $url);
        $crawler = $this->client->followRedirect();

        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function provideUrls()
    {
        return array(
            array('/aluno/'),
        );
    }

    public function testNew(){

        $this->logIn();

        $crawler  = $this->client->request('GET', "/aluno/");
        $crawler = $this->client->followRedirect();

        var_dump($crawler);
        $link = $crawler->selectLink('Create new')->link();

        $crawler = $this->client->click($link);

        $form = $crawler->selectButton('Save')->form();
        $crawler = $this->client->submit($form, array('nome' => 'Aluno PHP Unit'));

        $this->assertTrue($this->client->getResponse()->isRedirect());

    }



    private function logIn()
    {

        $crawler  = $this->client->request('GET', "/login");

        $form = $crawler->selectButton('login')->form();

        $form['_username'] = 'admin';
        $form['_password'] = '1';

        $crawler = $this->client->submit($form);
    }
}
