#!/usr/bin/env php
<?php declare(strict_types=1);
$options = getopt('', ['class:', 'release:', 'limit', 'size:']);
var_dump($options);