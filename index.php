<?php
    /**
     * The closing ?> tag MUST be omitted from files containing only PHP.
    * @see https://www.php-fig.org/psr/psr-12/
    *
    * @author Rayane Mallek (mallekr@3il.fr)
    */

    $ROOT_FOLDER = __DIR__;
    $DS = DIRECTORY_SEPARATOR;
    require_once $ROOT_FOLDER . $DS . 'lib' . $DS . 'File.php';
    require_once File::build_path(array("controller", "router.php"));
?>