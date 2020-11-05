<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT");
header("Access-Control-Allow-Headers: X-Page-Context, X-Page-Id, X-Csrf-Token, Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");
if ($_POST['id']) {
    $data = json_decode(file_get_contents('export-modhost.json'), true);
    if (empty($data)) {
        $data = [];
    }
    $id = 's' . $_POST['id'];
    if (!isset($data[$id])) {
        $data[$id] = [];
    }
    foreach ($_POST as $key => $value) {
        if ($key == 'date') {
            $tmp = explode(',', $value);
            $d = trim($tmp[0]);
            $time = trim($tmp[1]);
            $tmp = explode(' ', $d);
            $year = $tmp[2];
            $month = str_replace([
                    'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря',
                ], [
                    '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12',
                ], $tmp[1]);
            $day = $tmp[0];
            $value = $year . '-' . $month . '-' . $day . ' ' . $time . ':00';
        }
        $data[$id][$key] = $value;
    }
    file_put_contents('export-modhost.json', json_encode($data));
    echo 'ok';
} else {
    echo '<a href="javascript: ' .
            file_get_contents('export-modhost.js') .
           '">Экспортировать данныые</a>';
}