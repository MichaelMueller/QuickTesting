<?php

namespace Qck\Testing;

/**
 * Abstract class Test
 *
 * @author muellerm
 */
class FailedTestsException implements \Throwable
{
    
    public function __construct( $message = "", $code = 0, \Throwable $previous = NULL )
    {
        parent::__construct( $message, $code, $previous );
    }
}
