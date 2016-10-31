<?php
/**
 * Created by PhpStorm.
 * User: Adebola
 * Date: 31/10/2016
 * Time: 22:35
 */
require __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/Repository/GeoBuzzRepository.php';
\Samcrosoft\GeoBuzz\Repository\GeoBuzzRepository::parseIPToDetails('86.23.28.246');
