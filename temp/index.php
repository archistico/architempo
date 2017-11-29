<?php

$oggi = new DateTime();
$ieri = $oggi->sub( new DateInterval('P1D') )->format('Y-m-d H:i:s');

var_dump($ieri);