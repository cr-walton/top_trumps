<?php

require_once '../../vendor/autoload.php';

use Transformers\Classes\Transformer;
use PHPUnit\Framework\Testcase;

class WinRatioTest extends Testcase
{
    public function testSuccessWinRatio()
    {
        $transformerMock = $this->createMock(Transformer::class);
        $transformerMock->method('getName')->willReturn('Dave');
        $transformerMock->method('getWinRatio')->willReturn(8);

        //put it in an array
        $input = [$transformerMock];
        //create the string of HTML we would expect to see
        $expected = ['Dave' => 8];
        //call the static method we are testing with our test data
        $actual = Transformer::winRatioForEach($input);
        //compare the two to assert they are the same
        $this->assertEquals($expected, $actual);
    }
    public function testFailureWinRatio()
    {
        //expected result of the test
        $expected = [];
        //input for the test to get the result
        $testInput1 = [];
        //run the real function with the input
        $case = Transformer::winRatioForEach($testInput1);
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
        $case = Transformer::winRatioForEach($testInput1);
    }
}
