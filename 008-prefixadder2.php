<?php
require 'vendor/autoload.php';

class PrefixAdderVisitor
    extends \PhpParser\NodeVisitorAbstract
{
    public function leaveNode(\PhpParser\Node $node) {
        if ($node instanceof \PhpParser\Node\Name) {
            if ($node->isFullyQualified()) {
                return new PhpParser\Node\Name(
                    'Prefix\\' . (string)$node,
                    $node->getAttributes()
                );
            }
        }
    }
}

$source = file_get_contents('example3.php');

$statements = (new PhpParser\ParserFactory)
    ->create(PhpParser\ParserFactory::PREFER_PHP7)
    ->parse($source);
$traverser = (new \PhpParser\NodeTraverser());
$traverser->addVisitor(
    new PrefixAdderVisitor()
);
$result = $traverser->traverse($statements);
echo (new \PhpParser\NodeDumper())->dump($result);
