<?php

  /*
   * Проверки на ввод данных нет, т.к. по условию:
   * "Дано два положительных целых числа в виде строки."
   */

  echo bigSum('21474836473456', '187778248673498734534');

  function bigSum(string $x, string $y): string {
  	$maxLength = max(strlen($x), strlen($y));
  	$xRev = strrev($x);
    $yRev = strrev($y);

    $resultRev = '';
    $residue = 0;
    for ($i = 0; $i <= $maxLength; $i++) {
      $sum = (int)$xRev[$i] + (int)$yRev[$i] + $residue;
      $resultRev .= $sum % 10;
      $residue = floor($sum / 10);
    }

    return preg_replace("/^0+/", "", strrev($resultRev));
  }