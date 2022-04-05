<?php

declare(strict_types=1);

namespace ikarolaborda\coursesearch;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Searcher
{
    private ClientInterface $client;

    private Crawler $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->client = $httpClient;
        $this->crawler = $crawler;
    }

    public function search(string $url): array
    {
        $response = $this->client
            ->request('GET', $url);

        $html = (string)$response->getBody();

        $this->crawler->addHtmlContent($html);

        $elementCourses = $this->crawler->filter('span.card-curso__nome');
        $courses = [];

        foreach ($elementCourses as $element) {
            $courses[] = $element->textContent;
        }

        return $courses;
    }
}
