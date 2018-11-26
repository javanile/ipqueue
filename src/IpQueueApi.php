<?php

namespace Javanile\IpQueue;

class IpQueueApi
{
    /**
     * @var array
     */
    protected $headers;

    /**
     * @var array
     */
    protected $inputServer;

    /**
     * IpQueueApp constructor.
     *
     * @param $headers
     * @param $inputServer
     */
    public function __construct($headers, $inputServer)
    {
        $this->headers = $headers;
        $this->inputServer = $inputServer;
    }

    /**
     * @return string
     */
    public function run()
    {
        $json = [ 'request' => [] ];
        foreach ($this->headers as $key => $value) {
            $json['request'][strtolower($key)] = $value;
        }

        $json['request']['method'] = $this->inputServer['REQUEST_METHOD'];
        $json['service'] = [ 'name' => substr($json['request']['host'], 0, strpos($json['request']['host'], '.')) ];

        if (strlen($json['service']['name']) < 4) {
            $json['message'] = [ 'type' => 'error', 'text' => 'Service name is too short' ];
            return $this->json($json);
        }

        $path = __DIR__.'/data/'.$json['service']['name'][0].'/'.$json['service']['name'][1];
        $file = $path.'/'.$json['service']['name'].'.json';
        $have = file_exists($file);

        switch ($json['request']['method']) {
            case 'GET':
                return $have ? file_get_contents($file) : '';

            case 'POST':
                $json['service']['ip'] = $this->inputServer['REMOTE_ADDR'];
                if (!$have && !is_dir($path)) {
                    mkdir($path, 0777, true);
                }
                file_put_contents($file, $json['service']['ip']);
                $json['message'] = [ 'type' => 'success', 'text' => 'Service successful updated' ];
                break;

            default:
                $json['message'] = [
                    'type' => 'error', 'text' => 'Unsupported HTTP method: '.$json['request']['method']
                ];
                break;
        }

        return $this->json($json);
    }

    /**
     * Retrieve json response.
     *
     * @param $json
     * @return string
     */
    private function json($json)
    {
        return json_encode($json, JSON_PRETTY_PRINT)."\n";
    }
}
