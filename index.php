<?php
/**
 * javanile/ipqueue (v0.0.1)
 */

$json = [ 'request' => [] ];

foreach (getallheaders() as $key => $value) {
    $json['request'][strtolower($key)] = $value;
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
        $json['message'] = [ 'type' => 'Success', 'text' => 'service updated' ];
        break;

    default:
        $json['message'] = [ 'type' => 'Error', 'text' => 'Unsupported HTTP method: '.$json['request']['method'] ];
        break;
}

echo json_encode($json, JSON_PRETTY_PRINT)."\n";
