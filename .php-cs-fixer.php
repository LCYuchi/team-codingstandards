<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/app');

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12'        => true,
        'single_quote'  => true,
    ])
    ->setIndent("\t")
    ->setFinder($finder);
