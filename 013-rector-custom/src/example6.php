<?php

namespace src;
class A
{
    public int $property = 42;

    public function method(): int
    {
        return 42;
    }
}

/** @param A[] $a_array */
function f2(array $a_array): void
{
    foreach ($a_array as $a) {
        echo $a->property;
    }
}