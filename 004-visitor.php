<?php
require 'vendor/autoload.php';
use PhpParser\ParserFactory;
$source = file_get_contents('hello.php');
$parser = (new ParserFactory)->create(
    ParserFactory::PREFER_PHP7
);
$statements = $parser->parse($source);

$visitor = new class extends \PhpParser\NodeVisitorAbstract {};

assert($visitor instanceof PhpParser\NodeVisitor);
$traverser = (new PhpParser\NodeTraverser);
$traverser->addVisitor($visitor);
$traverser->traverse($statements);