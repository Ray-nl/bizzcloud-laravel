<?php

namespace Raynl\Bizzcloud;

use Ripcord\Providers\Laravel\Ripcord;

class Bizzcloud extends Ripcord
{
    public function __construct()
    {
        // Check if ENV files exists it not exsits throw error
        if (
            env('BIZZ_URL') == null && env('BIZZ_URL') == '' ||
            env('BIZZ_DB') == null && env('BIZZ_DB') == '' ||
            env('BIZZ_USERNAME') == null && env('BIZZ_USERNAME') == '' ||
            env('BIZZ_PASSWORD') == null && env('BIZZ_PASSWORD') == ''
        ) {
            throw new \ErrorException('Not all ENV values are set');
        }
    }

    public function products()
    {
        return $this->client->execute_kw(
            $this->db,
            $this->uid,
            $this->password,
            'product.template',
            'search_read',
            [],
            [
                'fields' => [
                    'list_price',
                    'name',
                    'barcode',
                    'qty_available',
                    'sale_ok',
                    'default_code',
                    'display_name'
                ]
            ]
        );
    }
}
