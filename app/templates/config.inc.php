<?php

date_defult_tomezone_set("Pacific/Auckland");

error_reporting(E_ALL);

define("DEV_ENVIRONMENT", false);

ini_set("display_errors", true);

ini_set("log_errors", 1);

ini_set("error_log", getcwd(). "/php-error.log");

define("DB_HOST", 'localhost');

define("DB NAME", 'diy-cleaning-website');

define("DB_USER", 'root');

define("DB_PASSWORD", '');
