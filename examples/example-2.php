<?php

$a = "asdasd";
$b = 2 % 4;
$c = $b % 2 != 0;
$d = !!$b;
$e = $b | $c;
$f = $d || $e;
$g = $a & $b;
$h = $a ^ $b;
$i = ~ $a;
$j = $a << $b;
$k = $a >> $b;
$l = $b / $c;
$m = $k + $l;
$n = $m > $l;
$o = $m < $l;
$p = $m <= ($l + $m);
$q = $m >= $l + $m;
$r = $m <=> $l + $m;
$s = $m <=> $l * $m;
$t = $m && $l;
$u = $m ? $s : $l;
$w = $m ?? $l;
$x = $m ?: $l;
$y = $m and $x;
$z = $m or $x;
$zz = 1 xor 2 | (2 and 3);
