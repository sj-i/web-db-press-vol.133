<?php
namespace RectorRules;

use PhpParser\Node;
use PHPStan\Type\ObjectType;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class ExampleRector extends AbstractRector {
    public function getNodeTypes(): array {
    return [Node\Expr\PropertyFetch::class];
  }

    /** @param Node\Expr\PropertyFetch $node */
    public function refactor(Node $node): ?Node {
    $type = $this->nodeTypeResolver->getType(
      $node->var
    );
    assert($type instanceof ObjectType);
    if ($type->getClassName() !== 'A'
        || (string)$node->name !== 'property') {
      return null;
    }
    return new Node\Expr\MethodCall(
        $node->var,
        'method'
    );
  }
    /** ルールの解説データを返す */
    public function getRuleDefinition(
    ): RuleDefinition {
        return new RuleDefinition(
            'example rector rule', [
                new CodeSample(
                    '$instanceOfA->property',
                    '$instanceOfA->getter()',
                )
            ]
        );
    }
}