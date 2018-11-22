<?php
/**
 * javanile/ipqueue (v0.0.1)
 */

$json = [ 'Request' => getallheaders() ];
$json['Request']['Method'] = $_SERVER['REQUEST_METHOD'];
$json['Service'] = [ 'Name' => substr($json['Request']['Host'], 0, strpos($json['Request']['Host'], '.')) ];

if (strlen($json['Service']['Name']) < 4) {
    $json['Message'] = [ 'Type' => 'Error', 'Text' => 'Service name is too short' ];
    echo json_encode($json, JSON_PRETTY_PRINT)."\n";
    exit(1);
}

switch ($json['Request']['Method']) {
    case 'GET':
        break;

    case 'POST':
        $json['Service']['Ip'] = $_SERVER['REMOTE_ADDR'];
        break;

    default:
        $json['Message'] = [ 'Type' => 'Error', 'Text' => 'Unsupported HTTP method: '.$json['Request']['Method'] ];
        break;
}

echo json_encode($json, JSON_PRETTY_PRINT)."\n";
