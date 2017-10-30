<?php
// Données de configuration
$config = array(
        'DB_HOST' => 'xxx',
        'DB_USER' => 'xxx',
        'DB_PASSWORD' => 'xxx',
        'DB_DATABASE' => 'xxx'
);
// Inclusion de fichiers
require_once __DIR__.'/db.php';
require_once __DIR__.'/functions.php';

// Inclusion de composer
require_once __DIR__.'/../vendor/autoload.php';

// Social Networks
// Create a Page instance with the url information
$socialLinksPage = new SocialLinks\Page([
    'url' => 'http://projet-toto.dev',
    'title' => 'Projet TOTO',
    'text' => 'Extended page description',
    'image' => 'http://mypage.com/image.png',
    'icon' => 'http://mypage.com/favicon.png',
    'twitterUser' => '@twitterUser'
]);
?>
