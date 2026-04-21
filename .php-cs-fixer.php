<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/app')
    ->notPath('Config')          // Configuration files
    ->notPath('Libraries/fpdf')  // Third-party libraries
    ->notPath('Views/errors');   // CodeIgniter built-in files

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12'                      => true,
        'single_quote'                => true,   // 原則シングルクォート
        'no_unused_imports'           => true,   // 未使用の use 文を削除
        'ordered_imports'             => true,   // use 文をアルファベット順に整列
        'no_extra_blank_lines'        => true,   // 余分な空行を削除
        'trailing_comma_in_multiline' => true,   // 複数行の最後の要素にカンマを追加
    ])
    ->setIndent("\t")
    ->setFinder($finder);
