<?php

declare(strict_types = 1);

use Irice\Learning\Permutation;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

class PermutationTest extends TestCase
{
    #[CoversNothing]
    #[DataProvider('solutionProvider')]
    #[Group('permutation')]
    public function testSolution(string $input1, array $input2, int $ans)
    {
        $class = new Permutation;
        $this->assertEquals($ans, $class->solution($input1, $input2));
    }

    public static function solutionProvider()
    {
        return [
            ['BILLOBILLOLLOBBI', ["BILL", "BOB"], 3],
            ['CAT', ["ILOVEMYDOG", "CATS"], 0],
            ['ABCDXYZ', ["ABCD", "XYZ"], 1],
            ['AAABBBB', ["AB", "B"], 4],
            ['AABBCCDDEEFFGGAABBCCDDEEFFGGAABBCCDDEEFFGGAABBCCDDEEFFGGAABBCCDDEEFFGGAABBCCDDEEFFGGAABBCCDDEEFFGAA', ['AA', 'BB', 'CC', 'DD', 'EE', 'FF', 'GG', 'HH', 'II', 'JJ'], 8],
        ];
    }
}