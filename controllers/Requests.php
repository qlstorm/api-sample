<?php

namespace controllers;

class Requests {

    public static function index($param) {
        \lib\Requests::api($param);
    }
}
