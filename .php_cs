<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
                                         ->exclude(['bower_components', 'node_modules', 'storage', 'vendor'])
                                         ->notName('AcceptanceTester.php')
                                         ->notName('FunctionalTester.php')
                                         ->notName('UnitTester.php')
                                         ->in(__DIR__);

return Symfony\CS\Config\Config::create()
                               ->level(Symfony\CS\FixerInterface::SYMFONY_LEVEL)
                               ->fixers([
                                   'align_double_arrow',
                                   'align_equals',
                                   'multiline_spaces_before_semicolon',
                                   'no_blank_lines_before_namespace',
                                   'ordered_use',
                                   'short_array_syntax',
                               ])
                               ->finder($finder);


