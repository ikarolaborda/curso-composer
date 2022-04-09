<?php
require '../vendor/autoload.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teste</title>
</head>
<body>
<?php
$client = new \GuzzleHttp\Client(['base_uri' => 'https://www.alura.com.br/']);
$crawler = new Symfony\Component\DomCrawler\Crawler();
$courseSearch = new \ikarolaborda\coursesearch\Searcher($client, $crawler);
$courses = $courseSearch->search('/cursos-online-programacao/php');
var_dump($courses);
?>
</body>
</html>
