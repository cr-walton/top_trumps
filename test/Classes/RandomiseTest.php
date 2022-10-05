<?php

require_once '../../vendor/autoload.php';

use Transformers\Classes\Transformer;
use PHPUnit\Framework\Testcase;

class RandomiseTest extends Testcase
{
    public function testSuccessWinRatio()
    {
        $transformerMock = $this->createMock(Transformer::class);
        $transformerMock2 = $this->createMock(Transformer::class);
        //put it in an array
        $input = [$transformerMock, $transformerMock2];
        //create the string of HTML we would expect to see
        $expected = 2;
        //call the static method we are testing with our test data
        $actual = Transformer::randomTransformers($input);
        //compare the two to assert they are the same
        $this->assertCount($expected, $actual);
    }
    public function testFailureWinRatio()
    {
        //expected result of the test
        $expected = [];
        //input for the test to get the result
        $testInput1 = [];
        //run the real function with the input
        $case = Transformer::randomTransformers($testInput1);
        //compare the expected result with the actual result
        $this->assertEquals($expected, $case);
    }

    public function testMalformedLeaderboard()
    {
        //input for the test to get the result
        $testInput1 = 1;
        // tell phpunit it should expect an error to be thrown
        $this->expectException(TypeError::class);
        //run the real function with the input
        $case = Transformer::randomTransformers($testInput1);
    }
}
