<?php

namespace Irice\Learning;

/* task 1 */
class Permutation
{
    public function solution($S, $L)
    {
        /*
        string $S 字串集, 長度100
        string[] $L 可能名稱, 長度10，字串長度100
        */
        $compareTimes = [0];
        $poll = str_split($S, 1);
        foreach ($L as $key => $name) {
            //逐字挑
            $charList = str_split($name, 1);
            $next = true;
            while ($next) {
                foreach ($charList as $char) {
                    $find = array_search($char, $poll);
                    if ($find === false) {
                        $next = false;
                        continue;
                    }
                    unset($poll[$find]);
                }
                //換下個候選字
                if ($next === false) {
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