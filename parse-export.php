<?php
$data = json_decode(file_get_contents('export-modhost.json'), true);
if (!empty($data)) {
    $output = [];
    foreach ($data as $site) {
        $output[] = $site['name'] . ';' . $site['date'] . ';' . $site['dev'] . ';' . implode(', ', $site['domains']);
    }
    file_put_contents('site-list.csv', implode(PHP_EOL, $output));
}