<?php
require 'vendor/autoload.php';

class EchoRemovingVisitor
    extends \PhpParser\NodeVisitorAbstract
{
    public function leaveNode(\PhpParser\Node $node) {
        if ($node instanceof \PhpParser\Node\Stmt\Echo_) {
            return \PhpParser\NodeTraverser::REMOVE_NODE;
        }
    }
}

$source = file_get_contents('example4.php');

$statements = (new PhpParser\ParserFactory)
    ->create(PhpParser\ParserFactory::PREFER_PHP7)
    ->parse($source);
$traverser = (new \PhpParser\NodeTraverser());
$traverser->addVisitor(
    new EchoRemovingVisitor()
);
$result = $traverser->traverse($statements);
echo (new \PhpParser\NodeDumper())->dump($result);
