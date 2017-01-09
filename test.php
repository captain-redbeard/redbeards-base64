<?php
/**
 *
 * Test implementation.
 *
 */
require 'Base64.php';

use Redbeard\Base64;

$f = "f";
$fo = "fo";
$foo = "foo";
$foob = "foob";
$fooba = "fooba";
$foobar = "foobar";

$ef = Base64::encode($f);
$efo = Base64::encode($fo);
$efoo = Base64::encode($foo);
$efoob = Base64::encode($foob);
$efooba = Base64::encode($fooba);
$efoobar = Base64::encode($foobar);

$df = Base64::decode($ef);
$dfo = Base64::decode($efo);
$dfoo = Base64::decode($efoo);
$dfoob = Base64::decode($efoob);
$dfooba = Base64::decode($efooba);
$dfoobar = Base64::decode($efoobar);

echo "-- Standard Tests Encode --<br/>";
echo $f . ": " . $ef . " - " . ($ef === 'Zg==' ? "true" : "false") .  "<br/>";
echo $fo . ": " . $efo . " - " . ($efo === 'Zm8=' ? "true" : "false") .  "<br/>";
echo $foo . ": " . $efoo . " - " . ($efoo === 'Zm9v' ? "true" : "false") .  "<br/>";
echo $foob . ": " . $efoob . " - " . ($efoob === 'Zm9vYg==' ? "true" : "false") .  "<br/>";
echo $fooba . ": " . $efooba . " - " . ($efooba === 'Zm9vYmE=' ? "true" : "false") .  "<br/>";
echo $foobar . ": " . $efoobar . " - " . ($efoobar === 'Zm9vYmFy' ? "true" : "false") .  "<br/><br/>";

echo "-- Standard Tests Decode --<br/>";
echo $f . ": " . $df . " - " . ($df === $f ? "true" : "false") .  "<br/>";
echo $fo . ": " . $dfo . " - " . ($dfo === $fo ? "true" : "false") .  "<br/>";
echo $foo . ": " . $dfoo . " - " . ($dfoo === $foo ? "true" : "false") .  "<br/>";
echo $foob . ": " . $dfoob . " - " . ($dfoob === $foob ? "true" : "false") .  "<br/>";
echo $fooba . ": " . $dfooba . " - " . ($dfooba === $fooba ? "true" : "false") .  "<br/>";
echo $foobar . ": " . $dfoobar . " - " . ($dfoobar === $foobar ? "true" : "false") .  "<br/>";