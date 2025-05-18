<?php
require 'vendor/autoload.php';

use Amp\Http\Client\HttpClientBuilder;
use Amp\Http\Client\Request;
use function Amp\async;
use function Amp\Future\await;

// urls to fetch
$urls = [
    'AMPHP'              => 'https://amphp.org/',
    'ReactPHP'           => 'https://reactphp.org/',
    'OpenSwoole'         => 'https://openswoole.com/',
    'Pecl'               => 'https://pecl.php.net/',
    'PHP.net'            => 'https://www.php.net/',
    'Wikipedia'          => 'https://en.wikipedia.org/wiki/PHP',
    'php[tek]'           => 'https://phptek.io/',
    'Eric Mann Mastodon' => 'https://tekton.network/@ericmann',
    'Laravel'            => 'https://laravel.com/',
    'Symfony'            => 'https://symfony.com/',
    'Packagist'          => 'https://packagist.org/',
];

// record overall start
$overallStart = microtime(true);

$client = HttpClientBuilder::buildDefault();

// create an array of Futures, one per URL
$futures = [];
foreach ($urls as $name => $url) {
    $futures[$name] = async(function () use ($client, $name, $url) {
        $start = microtime(true);
        /** @var \Amp\Http\Client\Response $response */
        $response = $client->request(new Request($url));
        $body = $response->getBody()->buffer(); // This is now a fiber-blocking call returning the string
        $elapsed = microtime(true) - $start;
        printf("[%s] fetched in %.3f seconds (size: %d bytes)\n",
            $name, $elapsed, strlen($body));
    });
}

// await all requests to complete
await($futures);

$totalElapsed = microtime(true) - $overallStart;
printf("Total time (concurrent): %.3f seconds\n", $totalElapsed);