<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([__DIR__ . '/src']);
    $rectorConfig->rule(
        RectorRules\ExampleRector::class
    );
};