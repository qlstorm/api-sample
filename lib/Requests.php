<?php

namespace lib;

class Requests {
    
    public static function api($param) {
        require 'conf.php';

        if ($conf['domain_enable'] && $_SERVER['HTTP_HOST'] != $conf['domain']) {
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $cond = [];

            if (isset($_GET['status'])) {
                $cond[] = 'status = \'' . Connection::escape($_GET['status']) . '\'';
            }

            if (isset($_GET['created_at'])) {
                $date = date('Y-m-d', strtotime($_GET['created_at']));
                $dateEnd = $date . ' 23:59:59';

                $cond[] = "(created_at > '$date' and created_at < '$dateEnd')";
            }

            $query = 'select * from requests';

            if ($cond) {
                $query .= ' where ' . implode(' and ', $cond);
            }

            $data = Connection::query($query)->fetch_all();

            echo json_encode($data);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            Connection::insert('requests', $_POST);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $row = Connection::query('select id, email from requests where id = ' . (int)$param)->fetch_assoc();

            if (!$row) {
                return;
            }

            $putdata = file_get_contents('php://input');

            $updateRow = [
                'id' => (int)$param,
                'status' => 'Resolved',
                'comment' => $putdata
            ];

            $res = Connection::insert('requests', $updateRow);

            if ($res) {
                mail($row['email'], 'update', $putdata);
            }
        }
    }
}
