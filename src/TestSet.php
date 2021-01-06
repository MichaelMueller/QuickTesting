<?php

namespace Qck\Testing;

/**
 * Abstract class Test
 *
 * @author muellerm
 */
class TestSet
{

    function __invoke()
    {
        $this->assertNoCyclicDependencies( get_class( $this ) );
        foreach ( $this->requiredTests as $requiredTest )
            $requiredTest();
    }

    function assertNoCyclicDependencies( $rootTestFqcn )
    {
        foreach ( $this->requiredTests as $requiredTest )
        {
            $requiredTestFqcn = get_class( $requiredTest );
            if ( $requiredTestFqcn == $rootTestFqcn )
                $this->raiseException( sprintf( "Cyclic test dependency detected: '%s' <- -> '%s'", $rootTestFqcn, $requiredTestFqcn ) );
            $requiredTest->assertNoCyclicDependencies( $rootTestFqcn );
        }
    }

    protected function raiseException( $message )
    {
        throw new \Exception( $message );
    }

    function requiredTests()
    {
        return $this->requiredTests;
    }

    /**
     *
     * @var Test[]
     */
    protected $requiredTests = [];

}
