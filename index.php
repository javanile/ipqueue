<?php
/**
 * javanile/ipqueue (v0.0.1)
 */

define('IPQUEUE_HOST', 'www.ipqueue.com');

$json = [ 'request' => [] ];
foreach (getallheaders() as $key => $value) {
    $json['request'][strtolower($key)] = $value;
}

if ($json['request']['host'] == IPQUEUE_HOST) {
    require_once __DIR__.'/public/index.php';
    exit(0);
}

$json['request']['method'] = $_SERVER['REQUEST_METHOD'];
$json['service'] = [ 'name' => substr($json['request']['host'], 0, strpos($json['request']['host'], '.')) ];

if (strlen($json['service']['name']) < 4) {
    $json['message'] = [ 'type' => 'error', 'text' => 'Service name is too short' ];
    echo json_encode($json, JSON_PRETTY_PRINT)."\n";
    exit(1);
}

$path = __DIR__.'/data/'.$json['service']['name'][0].'/'.$json['service']['name'][1];
$file = $path.'/'.$json['service']['name'].'.json';
$have = file_exists($file);

switch ($json['request']['method']) {
    case 'GET':
        if ($have) {
            echo file_get_contents($file);
        }
        exit(0);
        break;

    case 'POST':
        $json['service']['ip'] = $_SERVER['REMOTE_ADDR'];
        if (!$have && !is_dir($path)) {
            mkdir($path, 0777, true);
        }
        file_put_contents($file, $json['service']['ip']);
        $json['message'] = [ 'type' => 'success', 'text' => 'Service successful updated' ];
        break;

    default:
        $json['message'] = [ 'type' => 'error', 'text' => 'Unsupported HTTP method: '.$json['request']['method'] ];
        break;
}

echo json_encode($json, JSON_PRETTY_PRINT)."\n";
