<?php

namespace Irice\Learning;

class Skyline
{
    /**
     * 
     * @param int[] $buildings ex: [[2,9,10],[3,7,15],[5,12,12],[15,20,10],[19,24,8]]
     * @return int[] ex: [[2,10],[3,15],[7,12],[12,0],[15,10],[20,8],[24,0]]
     */
    public function solution(array $buildings): array
    {
        /**
         * 思路：以矩陣表格來記錄座標狀態，true為填滿，false為空白
         * ex:
         * ○○○○○○○○○○○○○○○○○○○○
         * ○○○○○○○○○○○○●●○○○○○○
         * ○○○○●●○○○○●●●●●○○○○○
         * ○○○○●●●○○○●●●●●●●○○○
         * ○○●●●●●○○○●●●●●●●○○○
         * ○○●●●●●○○●●●●●●●●○○○
         * ○○●●●●●○○●●●●●●●●○○○
         * ○○●●●●●○○●●●●●●●●○○○
         */
        $map = $this->generateMap($buildings);

        $lineGroups = [];
        $prevTop = null;
        $currentPoint = null;
        $group = [];
        foreach ($map as $rowNumber => $row) {
            foreach ($row as $colNumber => $col) {
                if ($col === false) continue;
                if ($row[$colNumber + 1] === true) continue;
                $currentPoint = [$rowNumber, $colNumber];
            }

            //處理建物間距
            if (count($lineGroups) > 0 && $row[0] === false){
                $currentPoint = [$rowNumber, 0];
            }

            //處理初始位置
            if ($currentPoint === null) {
                continue;
            }
            
            //處理高度變更
            if ($prevTop !== $currentPoint[1]) {
                $lineGroups[] = $group;
                $group = [];
            }

            $group[] = $currentPoint;
            $prevTop = $currentPoint[1];
        }
        $lineGroups[] = $group;
        $lineGroups[] = [[$rowNumber+1, 0]];
        
        //var_dump($lineGroups);exit;
        
        $ans = array_reduce($lineGroups, function($carry, $item) {
            if (count($item) !== 0) $carry[] = array_shift($item);
            return $carry;
        }, []);
        //var_dump($ans);exit;
        return $ans;
    }

    protected function generateMap(array $input): array
    {
        //總列數
        $rows = array_reduce($input, function ($r, $i) {
            $r = $r > $i[2] ? $r : $i[2];
            return $r;
        }, 0);
        //總行數
        $cols = array_reduce($input, function ($r, $i) {
            $r = $r > $i[1] ? $r : $i[1];
            return $r;
        }, 0);
        /**
         * ex:
         * [0][0], [0][1], [0][2], [0][3] ...
         * [1][0], [1][1], [1][2], [1][3] ...
         * ...
         */

        $map = array_fill(0, $cols, array_fill(0, $rows, false));

        //標記
        foreach ($input as $build) {
            for ($i = $build[0]; $i < $build[1]; $i++) {
                for ($j = 0; $j <= $build[2]; $j++) {
                    $map[$i][$j] = true;
                }
            }
        }
        return $map;
    }

    public function drawMap(array $input)
    {
        $map = $this->generateMap($input);
        echo "\n   0 1 2 3 4 5 6 7 8 9 0 1 2 3 4 5 6 7 8 9 0 1 2 3 4 5\n";
        for ($i = count($map) - 1; $i >= 0; $i--) {
            echo str_pad($i, 3, ' ');
            foreach ($map[$i] as $col) {
                echo $col ? "□ " : "● ";
            }
            echo PHP_EOL;
        }
    }
}
