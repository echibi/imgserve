<?php
/**
 * Created by Jonas Rensfeldt.
 * Date: 14/02/17
 */
use Slim\Http\Request;
use Slim\Http\Response;

$app->get( '/{width:[0-9]+}/{height:[0-9]+}', '\App\Controllers\HomeController:getRandomImage' );