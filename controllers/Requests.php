<?php

namespace controllers;

class Requests {

    public static function index($param = 0) {
        \lib\Requests::api($param);
    }
}
