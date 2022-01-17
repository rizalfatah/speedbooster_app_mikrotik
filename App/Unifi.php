<?php

namespace App;

use UniFi_API\Client;

class Unifi
{
    private function connection(): Client
    {
        $controller_url = 'https://' . IP_STORE['merapi'] . ':8443';
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

    public function getHostnameClient(String $mac): String
    {

        $connection = $this->connection();
        $login = $connection->login();

        if ($login) {
            $results = $connection->list_clients();
            foreach ($results as $result) {

                if (strtoupper($result->mac) == $mac) {
                    return $result->hostname;
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
