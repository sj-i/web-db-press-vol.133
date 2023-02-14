<?php
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\CloningVisitor;
use PhpParser\ParserFactory;

require 'vendor/autoload.php';

$source = file_get_contents('example4.php');

$parser = (new ParserFactory)->create(
    ParserFactory::PREFER_PHP7,
    $lexer = new \PhpParser\Lexer\Emulative([
        'usedAttributes' => [
            'comments',
            'startLine', 'endLine',
            'startTokenPos', 'endTokenPos',
        ],
    ])
);
$traverser = (new NodeTraverser());
$traverser->addVisitor(new CloningVisitor());
$old_statements = $parser->parse($source);
$old_tokens = $lexer->getTokens();
$new_statements = $traverser->traverse($old_statements);

// 別のTraverserと Visitorを使うなどして
// $new_statementsを操作

echo (new PhpParser\PrettyPrinter\Standard())
    ->printFormatPreserving(
        $new_statements,
        $old_statements,
        $old_tokens
    )
;