<?php

declare(strict_types = 1);

use Irice\Learning\Skyline;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

class SkylineTest extends TestCase
{
    #[CoversNothing]
    #[DataProvider('solutionProvider')]
    #[Group('nueip')]
    #[Group('skyline')]
    public function testSolution(array $input, array $ans)
    {
        $this->assertEquals($ans, (new Skyline)->solution($input));
    }

    #[CoversNothing]
    #[DataProvider('solutionProvider')]
    #[Group('nueip')]
    #[Group('skyline-draw')]
    public function testDrawMap(array $input)
    {
        $this->assertNull((new Skyline)->drawMap($input));
    }

    public static function solutionProvider()
    {
        return [
            [[[2,9,10],[3,7,15],[5,12,12],[15,20,10],[19,24,8]], [[2,10],[3,15],[7,12],[12,0],[15,10],[20,8],[24,0]]],
            [[[0,2,3],[2,5,3]], [[0,3],[5,0]]],
            //[[[0,2147483647,2147483647]], [[]]],
        ];
    }
}