<?php

function autocargador($clase) {
    require_once 'class/' . $clase . '.php';
}

spl_autoload_register('autocargador');