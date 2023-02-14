<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\Stmt\RemoveUnreachableStatementRector;

return function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([__DIR__ . '/src']);
    $rectorConfig->rule(
        RemoveUnreachableStatementRector::class
    );
};