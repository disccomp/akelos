#!/usr/bin/env php
<?php

$argv = $_SERVER['argv'];
array_shift($argv);
passthru(dirname(__FILE__).DIRECTORY_SEPARATOR.'script'.DIRECTORY_SEPARATOR.'setup '.implode(' ',$argv));

