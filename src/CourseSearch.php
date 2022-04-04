<?php

namespace coursesearch;

require "./vendor/autoload.php";

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client();
try {
    $response = $client->request('GET', 'https://www.alura.com.br/cursos-online-programacao/php');
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    $e->getMessage();
}

$html = $response->getBody();

$crawler = new Crawler();
$crawler->addHtmlContent($html);
$courses = $crawler->filter('span.card-curso__nome');

foreach ($courses as $course) {
    file_put_contents('lista-cursos.txt', $course->textContent . PHP_EOL, FILE_APPEND);
}
