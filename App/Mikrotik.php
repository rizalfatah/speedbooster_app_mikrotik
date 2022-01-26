<?php

namespace App;

use \RouterOS\Client;

class Mikrotik
{

    private $ipStore;

    public function __construct($ip)
    {
        $this->ipStore = $ip;
    }

    private function loginMikrotik(): Client
    {
        return new Client([
            'host'        => $this->ipStore,
            'user'        => MIKROTIK_USERNAME,
            'pass'        => MIKROTIK_PASSWORD,
            'port'    => MIKROTIK_PORT,
        ]);
    }

    // daftar simple queue speedbooster
    public function getQueueSpeedbooster(): array
    {
        $response = $this->loginMikrotik()->query('/queue/simple/print', ['max-limit', BANDWITH_SPEEDBOOSTER]);
        return $response->read();
    }

    public function getCountQueueSpeedbooster(): int
    {
        return count($this->getQueueSpeedbooster());
    }

    // data single akun voucher superhotspot
    public function getDetailDataVoucher(String $username): ?array
    {
        $datas = $this->loginMikrotik()->query('/ip/hotspot/active/print');
        foreach ($datas->read() as $data) {
            if ($data['user'] == $username)
                return $data;
        }
        return null;
    }

    // akumulasi ip user yang menggunakan speedbooster di semua store ILC
    public function getListSpeedboosterAllStore(): int
    {
        $countListSpeedbooster = 0;

        foreach (IP_STORE_MULTIMEDIA as $ip) {
            $router = new Mikrotik($ip);
            $countListSpeedbooster += count($router->getQueueSpeedbooster());
        }
        return $countListSpeedbooster;
    }
}
