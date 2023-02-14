<?php

use \PhpParser\NodeVisitorAbstract;
use \PhpParser\Node;

require 'vendor/autoload.php';

$ast = (new PhpParser\ParserFactory)
  ->create(PhpParser\ParserFactory::PREFER_PHP7)
  ->parse(file_get_contents('example.php'));

$traverser = (new \PhpParser\NodeTraverser());
$traverser->addVisitor(
  new class() extends NodeVisitorAbstract {
    public function leaveNode(Node $node)
    {
      if ($node instanceof Node\Stmt\Function_) {
        foreach ($node->getParams() as $param) {
          if ($param->var->name === 'hoge') {
            echo $node->name, PHP_EOL;
          }
        }
      }
      return null;
    }
  }
);
$traverser->traverse($ast);
