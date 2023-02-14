<?php
require 'vendor/autoload.php';

$source = file_get_contents('example2.php');

$statements = (new PhpParser\ParserFactory)
    ->create(PhpParser\ParserFactory::PREFER_PHP7)
    ->parse($source);
$traverser = (new \PhpParser\NodeTraverser());
$traverser->addVisitor(
    new \PhpParser\NodeVisitor\NameResolver()
);
$traverser->traverse($statements);
echo (new \PhpParser\NodeDumper())->dump($statements);