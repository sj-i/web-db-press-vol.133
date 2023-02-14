<?php
require 'vendor/autoload.php';

$source = file_get_contents('example4.php');

$parser = (new PhpParser\ParserFactory)
    ->create(PhpParser\ParserFactory::PREFER_PHP7);

$ast = $parser->parse($source);
$prettyPrinter = new PhpParser\PrettyPrinter\Standard;
$newCode = $prettyPrinter->prettyPrintFile($ast);