<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('vendor')
    ->exclude('storage')
    ->exclude('node_modules')
    ->exclude('tools')
    ->exclude('public')
;

$config = new PhpCsFixer\Config();
return $config->setFinder($finder)
;
