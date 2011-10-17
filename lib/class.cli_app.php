<?php

define('NEWLINE', "\n");

define('COLOR_BLACK', "\033[0;30m");
define('COLOR_RED', "\033[0;31m");
define('COLOR_GREEN', "\033[0;32m");
define('COLOR_YELLOW', "\033[0;33m");
define('COLOR_BLUE', "\033[0;34m");
define('COLOR_MAGENTA', "\033[0;35m");
define('COLOR_CYAN', "\033[0;36m");
define('COLOR_WHITE', "\033[0;37m");

define('COLOR_RESET', "\033[0;37m");

class cli_app {
	
	function __construct() {
		echo NEWLINE;
	}
	
	function _destruct() {
		echo NEWLINE;
	}

	public function output($string) {
		echo ' '.$string.COLOR_RESET.NEWLINE;
	}

	public function title($string, $color = COLOR_RESET) {
		echo ' '.$color.$string.NEWLINE;
		echo ' '.str_repeat('-', strlen($string)).COLOR_RESET.NEWLINE;
	}
	
	public function newline() {
		echo NEWLINE;
	}

	public function table($headers, $rows, $header_color = COLOR_RESET, $row_color = COLOR_RESET) {
		$widths = array();
		$widths = self::tableCalcWidths($headers, $widths);
		foreach($rows as $row) {
			$widths = self::tableCalcWidths($row, $widths);
		}
		$border = '+';
		foreach ($headers as $column => $header) {
			$border .= '-'.str_repeat('-', $widths[$column]).'-+';
		}
		self::output($border);
		self::output(self::tableRow($headers, $widths, $header_color));
		self::output($border);
		foreach ($rows as $row) {
			self::output(self::tableRow($row, $widths, $row_color));
		}
		self::output($border);
	}

	protected function tableCalcWidths($row, $widths) {
		foreach ($row as $column => $value) {
			$width = strlen($value);
			if ((isset($widths[$column]) === false) || ($width > $widths[$column])) {
				$widths[$column] = $width;
			}
		}
		return $widths;
	}

	protected function tableRow($row, $widths, $value_color = COLOR_RESET) {
		$string = '|';
		foreach ($row as $column => $value) {
			$string .= ' '.$value_color.str_pad($value, $widths[$column]).COLOR_RESET.' |';
		}
		return $string;
	}
	
}