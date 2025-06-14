<?php
// public/index.php

$loadStart = microtime(true); // Начало замера времени

require_once '../bootstrap.php';

require_once '../router.php';

// Окончание замера времени будет в футере
