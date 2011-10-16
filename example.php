#!/usr/bin/php
<?php

if (php_sapi_name() !== 'cli') {
	die('This script is designed for execution from the command line');
}

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);
ini_set('log_errors', false);
ini_set('html_errors', false);

require_once(__DIR__.'/lib/class.cli.php');

cli::start();

cli::title('Welcome to my example script!', COLOR_YELLOW);
cli::newline();

cli::output('Here is an example table.');
cli::newline();

$headers = array('Country', 'TLD');
$data = array(
	array('Belgium', 'be'),
	array('Croatia', 'hr'),
	array('Denmark', 'dk'),
	array('Malta', 'mt'),
	array('Spain', 'es'),
	array('Sweden', 'se'),
	array('United Kingdom', 'uk'),
);
cli::table($headers, $data, COLOR_GREEN, COLOR_YELLOW);

cli::end();