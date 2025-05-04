<?php

function autocargador($clase) {
    require_once 'clases/' . $clase . '.php';
}

spl_autoload_register('autocargador');