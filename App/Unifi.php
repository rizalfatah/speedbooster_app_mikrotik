<?php

namespace App;

use UniFi_API\Client;

class Unifi
{

    public String $ipStore;


    public function __construct($ip)
    {
        $this->ipStore = $ip;
    }
    private function connection(): Client
    {
        $controller_url = "https://{$this->ipStore}:8443";
        $site_id = 'default';
        $controller_version = '6.2.26';
        $connection = new Client(UNIFI_USERNAME, UNIFI_PASSWORD, $controller_url, $site_id, $controller_version, false);
        return $connection;
    }

    // Pengecekan apakah perangkat user support speedboster?
    // minimal rate 1.5x lebih tinggi dari badnwith speedbooster atau
    // minimal sudah support 5ghz
    public function getListClients(): array
    {
        $connection = $this->connection();
        $login = $connection->login();

        if ($login) {
            $results = $connection->list_clients();
            return $results;
        } else {
            return 'Koneksi bermasalah';
        }
    }

    public function getHostnameClient(String $mac): ?String
    {

        $connection = $this->connection();
        $login = $connection->login();

        // bug ketika tidak ada hostname dalam array (user prevent show hostname)
        if ($login) {
            $results = $connection->list_clients();
            foreach ($results as $result) {
                // var_dump($result);
                if (strtoupper($result->mac) == $mac) {
                    // ada kemungkinan user tidak memiliki hostname
                    if (isset($result->hostname))
                        return $result->hostname;
                    else
                        return $result->mac;
                }
            }
        } else {
            return 'Koneksi bermasalah';
        }
    }

    public function login(): void
    {
        try {
            $connection = $this->connection();
            $login = $connection->login();
        } catch (\Throwable $th) {
            echo 'error ' . $th;
        }
    }
}
