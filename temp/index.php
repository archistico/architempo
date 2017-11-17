<?php

function AUTORIZZATO($admitted_role) {
    // $admitted_role is array
    if(in_array('Amm', $admitted_role)) {
        return true;
    } else {
        return false;
    }
}

echo Autorizzato(['cliente', 'Lav'])?"Passed!":"Not passed";