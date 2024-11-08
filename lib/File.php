<?php

/**
  * The closing ?> tag MUST be omitted from files containing only PHP.
  * @see https://www.php-fig.org/psr/psr-12/
  *
  * @author Rayane Mallek (mallekr@3il.fr)
*/

class File {

	public static function build_path($path_array) {
    	$ROOT_FOLDER = __DIR__;
    	$DS = DIRECTORY_SEPARATOR;

    	return $ROOT_FOLDER . $DS . '..' . $DS . 'src' . $DS . join($DS, $path_array);
	}
}
