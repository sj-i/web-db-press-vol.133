<?php
$source = file_get_contents('hello.php');
$tokens = PhpToken::tokenize($source);
foreach ($tokens as $token) {
    var_dump($token->getTokenName());
}