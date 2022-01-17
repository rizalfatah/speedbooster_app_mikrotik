<?php

use \RouterOS\Client;

function loginMikrotik() {
    $client = new Client([
        'host'        => IP_LOKAL_NETCITY,
        'user'        => USERNAME_MIKROTIK,
        'pass'        => PASSWORD_MIKROTIK,
        'port'    => PORT_MIKROTIK,
    ]);
    return $client;
}

// return all queue with speed_booster bandwidth
function getQueue() {
    $response = loginMikrotik()->query('/queue/simple/print', ['max-limit', BANDWITH_SPEEDBOOSTER]);
    return $response->read();
}

// return detail data single account
function getDetailDataVoucher($username) {
    $datas = loginMikrotik()->query('/ip/hotspot/active/print');
    foreach ($datas->read() as $data) {
        if ($data['user'] == $username)
            return $data;
    }
}

function loginUnifi() {
    $controller_user = USERNAME_UNIFI;
    $controller_password = PASSWORD_UNIFI;
    // $controller_url = 'https://' . IP_UNIFI_CONTROLLER_NETCITY .  ':8443';
    $controller_url = 'https://192.168.3.2:8443';

    $site_id = 'default';
    $controller_version = '6.2.26';

    $unifi_connection = new UniFi_API\Client($controller_user, $controller_password, $controller_url, $site_id, $controller_version, false);
    return $unifi_connection;
}


// Pengecekan apakah perangkat user support speedboster?
// minimal rate 1.5x lebih tinggi dari badnwith speedbooster atau
// minimal sudah support 5ghz
function getClientUnifi() {
    $unifi_connection = loginUnifi();
    $login            = $unifi_connection->login();

    if ($login) {
        $results          = $unifi_connection->list_clients();
        return $results;
    } else {
        return 'Koneksi bermasalah';
    }
}

function getHostnameClient($mac) {

    $unifi_connection = loginUnifi();
    $login            = $unifi_connection->login();

    if ($login) {
        $results = $unifi_connection->list_clients();
        foreach ($results as $result) {

            if (strtoupper($result->mac) == $mac) {
                return $result->hostname;
            }
        }
    } else {
        return 'Koneksi bermasalah';
    }
}
