<?php

namespace lib;

class Init {

    public static function init() {
        if (!Connection::query('show tables like \'requests\'')->fetch_assoc()) {
            Connection::queryMulti(file_get_contents('db.sql'));
        }
    }
}
