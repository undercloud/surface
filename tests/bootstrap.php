<?php
foreach (glob(__DIR__ . '/../src/Surface/*.php') as $path) {
    require $path;
}