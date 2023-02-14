<?php
require 'vendor/autoload.php';
$source = file_get_contents('hello.php');
$parser = (new PhpParser\ParserFactory)->create(
    PhpParser\ParserFactory::PREFER_PHP7
);
$statements = $parser->parse($source);
echo (new PhpParser\NodeDumper)->dump($statements);