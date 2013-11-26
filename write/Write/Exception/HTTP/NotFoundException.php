<?php
namespace Write\Exception\HTTP;

use ErrorException;

class NotFoundException extends ErrorException {


    public function __construct($message = "", $code = E_USER_ERROR, $severity = 1, $filename = __FILE__, $lineno = __LINE__, $previous)
    {
        parent::__construct( $message, $code, $severity, $filename, $lineno, $previous );
    }
}