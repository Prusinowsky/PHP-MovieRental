<?php

use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Url;
use Pecee\Http\Response;
use Pecee\Http\Request;

/**
 * Zwaraca url ścieżny uczywajac nazwy, aliara, klasy lub nazwy metody
 *
 * Parametr wspiera następujące wartości
 * - Nazwa ścieżki
 * - Controller/nazwa zasobu (z lub bez metody)
 * - Nazwa klasy kontrollera
 *
 * @param string|null $name
 * @param string|array|null $parameters
 * @param array|null $getParams
 * @return \Pecee\Http\Url
 * @throws \InvalidArgumentException
 */
function url(?string $name = null, $parameters = null, ?array $getParams = null): Url
{
    return Router::getUrl($name, $parameters, $getParams);
}

/**
 * @return \Pecee\Http\Response
 */
function response(): Response
{
    return Router::response();
}

/**
 * @return \Pecee\Http\Request
 */
function request(): Request
{
    return Router::request();
}

/**
 * Zwarcanie klasy wejść
 * @param string|null $index Klucz wartości
 * @param string|null $defaultValue Wartość domyślna zwracana
 * @param array ...$methods Metody domyślne
 * @return \Pecee\Http\Input\InputHandler|array|string|null
 */
function input($index = null, $defaultValue = null, ...$methods)
{
    if ($index !== null) {
        return request()->getInputHandler()->value($index, $defaultValue, ...$methods);
    }

    return request()->getInputHandler();
}

/**
 * @param string $url
 * @param int|null $code
 */
function redirect(string $url, ?int $code = null): void
{
    if ($code !== null) {
        response()->httpCode($code);
    }

    response()->redirect($url);
}

/**
 * Generowanie widoków
 */
function view($path, $data = []){
    $prefix = '/views/';
    extract($data);
    return eval("?>".file_get_contents(__DIR__.$prefix.$path)."<?php");
}

/**
 * Generowanie widoków
 */
function view_include($path){
    $prefix = '/views/';
    return include(__DIR__.$prefix.$path);
}