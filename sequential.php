<?php
// urls to fetch
$urls = [
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

foreach ($urls as $name => $url) {
    $start = microtime(true);
    $body  = file_get_contents($url);
    $elapsed = microtime(true) - $start;
    printf("[%s] fetched in %.3f seconds (size: %d bytes)\n",
        $name, $elapsed, strlen($body));
}

$totalElapsed = microtime(true) - $overallStart;
printf("Total time (sequential): %.3f seconds\n", $totalElapsed);