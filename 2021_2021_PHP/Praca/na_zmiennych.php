<?php
echo "Pain<br>";
echo "Pain<br>";
echo "Pain<br>";
$name ="janusz";
echo "Imie: name";
echo 'Imie: $name';


 //typy danych

 //całkowite

 $całkowita=10;
 //Binarnie zaczynamy 0b
 $cos=0b1110;

 //oktalna zaczyna się 0
 $smutek=011;

 //heksalna 0x
 $hex=0x34;

 //.kontakentancja ,interpolacja
 echo $hex."<br>";

 //zmiennoprzecinkowe

 $x=10.5;

 echo gettype($x); //double

//logiczne

$prawda=true;//1
$falsz=false;//nic nie wyświetli
echo $falsz;

//składnia heredoc

echo <<< L
  <hr>
  imie: $name<br>
  Poznań<hr>

L;

echo "nazwa zmiennej z imienie: $name";
?>
