<?php

require "../vendor/autoload.php";
ini_set('xdebug.dump.SERVER','*');
ini_set('xdebug.dump.GET', '*');
$client = new \GuzzleHttp\Client(['base_uri' => 'https://www.alura.com.br.something/']); //inexistent domain
$crawler = new Symfony\Component\DomCrawler\Crawler();
$courseSearch = new \ikarolaborda\coursesearch\Searcher($client, $crawler);
$courses = $courseSearch->search('/cursos-online-programacao/php');
