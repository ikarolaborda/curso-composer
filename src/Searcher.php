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

    public function search(string $url, bool $testmode = false): array
    {
        try {
            $response = $this->client
                ->request('GET', $url);

            $html = (string)$response->getBody();

            $this->crawler->addHtmlContent($html);

            $elementCourses = $this->crawler->filter('span.card-curso__nome');
            $courses = [];

            foreach ($elementCourses as $element) {
                $courses[] = $element->textContent;
            }


        } catch (\GuzzleHttp\Exception\ConnectException $error) {
           throw new \DomainException('The requested domain does not exist or is not reachable at the moment',0,$error);
        }
        $resultCourses[] = !empty($courses) ? $courses : $courses[] = 'No course!';
        if($testmode) {
            return $courses;
        }
        return $resultCourses;
    }
}
