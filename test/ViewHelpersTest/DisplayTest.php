<?php

require_once '../../vendor/autoload.php';

use Transformers\Classes\Transformer;
use Transformers\ViewHelpers\Display;
use PHPUnit\Framework\Testcase;


class DisplayTest extends Testcase
{
    public function testSuccessDisplayTransformers()
    {
        //mock a transformer object
        $transformerMock = $this->createMock(Transformer::class);

        $transformerMock->method('getId')->willReturn(1);
        $transformerMock->method('getName')->willReturn('Dave');
        $transformerMock->method('getSize')->willReturn(2);
        $transformerMock->method('getSpeed')->willReturn(3);
        $transformerMock->method('getPower')->willReturn(4);
        $transformerMock->method('getDisguise')->willReturn(5);
        $transformerMock->method('getTop_trumps_rating')->willReturn(6);
        $transformerMock->method('getType')->willReturn('bananas');
        $transformerMock->method('getImg_url')->willReturn('pineapple.jpg');
        $transformerMock->method('getWins')->willReturn(7);
        $transformerMock->method('getPlayed')->willReturn(8);


        //put it in an array
        $input = [$transformerMock];
        //create the string of HTML we would expect to see
        $expected = '<div class="card col-3 d-flex justify-content-center text-center">';
        $expected .= '<h1 class="card-title">Dave</h1><img style="max-height: 250" class="rounded-start card-img-top" src="pineapple.jpg">';
        $expected .= '<p>Size: 2 Speed: 3</p><p>Power: 4 Disguise: 5</p><p>Rating: 6 Type: bananas</p><p>Wins: 7 Played: 8</p>';
        $expected .= '<form method=\'post\' action=\'verify.php\'><input type=\'hidden\' name=\'id\' value=1>';
        $expected .= '<input type=\'hidden\' name=\'wins\' value=7><button class=\'btn btn-secondary\' type=\'submit\'>Click to win!</button></form></div>';
        //call the static method we are testing with our test data
        $actual = Display::displayTopTrumps($input);
        //compare the two to assert they are the same
        $this->assertEquals($expected, $actual);
    }

    public function testFailureDisplayTransformers()
    {
        //expected result of the test
        $expected = '';
        //input for the test to get the result
        $testInput1 = [];
        //run the real function with the input
        $case = Display::displayTopTrumps($testInput1);
        //compare the expected result with the actual result
        $this->assertEquals($expected, $case);
    }

    public function testMalformeddisplayCharacters()
    {
        //input for the test to get the result
        $testInput1 = 1;
        // tell phpunit it should expect an error to be thrown
        $this->expectException(TypeError::class);
        //run the real function with the input
        $case = Display::displayTopTrumps($testInput1);
    }

    public function testSuccessLeaderboard()
    {
        //put it in an array
        $input = ['Dave' => 10];
        //create the string of HTML we would expect to see
        $expected = '<div class=\'container d-flex justify-content-center\'>';
        $expected .= '<p><span class=\'fw-semibold\'>Dave  </span>';
        $expected .= ' Win Ratio: 10</div>';
        //call the static method we are testing with our test data
        $actual = Display::displayLeaderboard($input);
        //compare the two to assert they are the same
        $this->assertEquals($expected, $actual);
    }
    public function testFailureLeaderboard()
    {
        //expected result of the test
        $expected = '';
        //input for the test to get the result
        $testInput1 = [];
        //run the real function with the input
        $case = Display::displayLeaderboard($testInput1);
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
        $case = Display::displayLeaderboard($testInput1);
    }
}
