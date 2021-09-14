<?php

echo PHP_VERSION;

echo 2**10;

$x=1;

$y=10;

echo $x<=>$y; //Mniejsze -1. równe 0 większe 1

$x=1;

$y=1.0;

if ($x==$y)
{
  echo "Równe";
}
else {
 echo "różne";
}
if ($x===$y)
{
  echo "Identyczne";
}
else {
 echo "Nie_Identyczne";
}

echo gettype($x);

echo gettype($y);

//post inkrementacja $x++;
// pre inkrementacja ++$x;
// post dekrementacja $x--;
// pre dekrementacja --$x;


//Zad 1

$x = 1;

echo $x;//1

$x=$x++;

echo $x;//1

$x=++$x;
echo $x;//2

$y=++$x;

echo $x;//3
echo $y;//3

$y=$x++;

echo $x;//4
echo $y;//3


?>
