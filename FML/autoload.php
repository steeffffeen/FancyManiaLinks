<?php

/**
 * FancyManiaLinks - Automatic ManiaLink Generator Framework
 *
 * @author steeffeen
 * @version 1.0
 */
if (!defined('FML_PATH')) {
	define('FML_PATH', __DIR__ . '/../');
}
if (!defined('FML_VERSION')) {
	define('FML_VERSION', 1.0);
}

spl_autoload_register(
		function ($className) {
			$classPath = str_replace('\\', DIRECTORY_SEPARATOR, $className);
			$filePath = FML_PATH . DIRECTORY_SEPARATOR . $classPath . '.php';
			if (file_exists($filePath)) {
				require_once $filePath;
			}
		});
