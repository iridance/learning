<?php

namespace Irice\Learning;

/** task 3 */
class Division3
{
	public static function solution($S) {
		/* string $S, 最大長度=100000, 0-9組成 */
		/* 取得總長 */
		$length = strlen($S);
		
		$answerCounter = 0;
		$baseSum = Division3::summary($S);
		/* 若原始值可整除 */
		if ($baseSum % 3 === 0) {
			$answerCounter++;
		}
		for ($i = 0; $i<$length; $i++) {
			$strPrev = substr($S, 0, $i);
			$strNext = substr($S, ($i+1));
			$tmpMod = ($baseSum - (int)$S[$i]) % 3;
			/* 若排除目前字元可整除 */
			if ($tmpMod === 0 && $S !== $strPrev . '0' . $strNext) {
				$answerCounter++;
			}
			for ($j = 3; $j<=9; $j += 3) {
				$tmp = $strPrev . (string)($j - $tmpMod) . $strNext;
				if ($tmp === $S) { continue; }
				$answerCounter++;
			}
		}
		return $answerCounter;
	}

	public static function summary($target) {
		$res = fopen('php://memory', 'r+');
		fwrite($res, $target);
		rewind($res);
		$result = 0;
		while(false !== ($char = fgetc($res))) {
			$result += (int) $char;
		}
		return $result;
	}
}