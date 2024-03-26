<?php

namespace Irice\Learning;

/* task 1 */
class Permutation
{
    /**
     * 
     * @param string $S 字數最大100
     * @param string[] $L 可選名字，最多10，字數最大100
     * @return int 
     */
    public function solution(string $S, array $L): int
    {
        $compareTimes = [0];
        //拆成字碼總池
        $poll = str_split($S, 1);
        foreach ($L as $key => $name) {
            //逐字計算
            $charList = str_split($name, 1);
            $tmpPoll = $poll;
            $nextChar = true;
            while ($nextChar) {
                foreach ($charList as $char) {
                    $find = array_search($char, $tmpPoll);
                    if ($find === false) {
                        $nextChar = false;
                        continue;
                    }   
                    unset($tmpPoll[$find]);
                }
                //換下個候選字
                if ($nextChar === false) {
                    break;
                }
                //計算加總
                if (isset($compareTimes[($key + 1)])) {
                    $compareTimes[($key + 1)] += 1;
                } else {
                    $compareTimes[($key + 1)] = 1;
                }
            }
        }

        //挑最大的當結果
        return max($compareTimes);
    }
}