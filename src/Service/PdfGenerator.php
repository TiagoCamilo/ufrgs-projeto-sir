<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 11/11/18
 * Time: 11:08.
 */

namespace App\Service;

use Mpdf\Mpdf;
use Symfony\Component\HttpFoundation\Response;

class PdfGenerator
{
    private $cssDirectory;
    private $generator;

    public function __construct($cssDirectory)
    {
        $this->generator = new Mpdf();
        $this->cssDirectory = $cssDirectory;
    }

    public function setContent(string $content)
    {
        $this->generator->WriteHTML($content);
    }

    public function setStyle(string $stylesheet)
    {
        $stylesheetContent = file_get_contents($this->cssDirectory.'/'.$stylesheet);
        $this->generator->WriteHTML($stylesheetContent, 1);
    }

    public function generate(): Response
    {
        $this->generator->Output();

        return new Response();
    }
}
