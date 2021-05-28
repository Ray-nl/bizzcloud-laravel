<?php

$excluded_folders = [
    'storage',
    'vendor',
    'bootstrap/cache',
    'node_modules',
];

$finder = PhpCsFixer\Finder::create()
    ->exclude($excluded_folders)
    ->notName('AcceptanceTester.php')
    ->notName('FunctionalTester.php')
    ->notName('UnitTester.php')
    ->notName('_ide_helper.php')
    ->in(__DIR__);

$config = new PhpCsFixer\Config();
return $config
    ->setRules([
        '@PSR2'                                       => true,
        'combine_consecutive_unsets'                  => true,
        'phpdoc_separation'                           => true,
        'multiline_whitespace_before_semicolons'   => true,
        'single_line_comment_style' => true,
        'single_quote'                                => true,
        'declare_equal_normalize'                     => true,
        'function_typehint_space'                     => true,
        'include'                                     => true,
        'lowercase_cast'                              => true,
        'no_leading_namespace_whitespace'             => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_spaces_around_offset'                     => true,
        'no_unused_imports'                           => true,
        'no_whitespace_before_comma_in_array'         => true,
        'no_whitespace_in_blank_line'                 => true,
        'object_operator_without_whitespace'          => true,
        'single_blank_line_before_namespace'          => true,
        'ternary_operator_spaces'                     => true,
        'trim_array_spaces'                           => true,
        'unary_operator_spaces'                       => true,
        'whitespace_after_comma_in_array'             => true,
        'encoding'                                    => true,
        'array_indentation' => true,
        'array_syntax' => [
            'syntax' => 'short',
        ],
        'braces' => [
            'allow_single_line_closure' => true,
        ],
        'ordered_imports' => [
            'imports_order'  => null,
            'sort_algorithm' => 'length'
        ],
        'no_extra_blank_lines' => true,
        'concat_space' => [
            'spacing' => 'one',
        ],
    ])
    ->setFinder($finder);
