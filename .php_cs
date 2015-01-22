<?php

//todo: add some of de CONTRIB filters

$finder = Symfony\CS\Finder\DefaultFinder::create()
                                         ->exclude(['bower_components', 'node_modules', 'storage', 'vendor'])
                                         ->in(__DIR__);

return Symfony\CS\Config\Config::create()
                               ->level(Symfony\CS\FixerInterface::SYMFONY_LEVEL)
                               ->finder($finder);