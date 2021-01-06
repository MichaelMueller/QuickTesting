<?php

namespace Qck\Testing;

/**
 * Abstract class Test
 *
 * @author muellerm
 */
abstract class Test extends TestSet
{

    /**
     * runs the actual Test
     */
    abstract protected function test();

    function __invoke()
    {
        $this->assertNoCyclicDependencies( get_class( $this ) );
        foreach ( $this->requiredTests as $requiredTest )
            $requiredTest();
        $this->test();
    }

    protected function assert( $condition, $message = null )
    {
        if ( $condition === false )
            $this->raiseException( "Test '" . get_class( $this ) . "' failed" . ($message ? ". Reason: " . $message : null) );
    }

}
