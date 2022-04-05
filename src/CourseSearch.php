<?php

namespace ikarolaborda\coursesearch;

require "./vendor/autoload.php";

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

try {
    $client = new Client(['base_uri' => 'https://www.alura.com.br/']);
    $crawler = new Crawler();
    $searcher = new Searcher($client, $crawler);
    $courses = $searcher->search('/cursos-online-programacao/php');
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    $e->getMessage();
}

if (isset($courses)) {
    foreach ($courses as $course) {
        file_put_contents('lista-cursos.txt', $course . PHP_EOL, FILE_APPEND);
    }
}
