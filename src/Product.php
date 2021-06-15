<?php

namespace Raynl\Bizzcloud;

use Exception;

class Product extends Bizzcloud
{
    /**
     * Get all products
     *
     * @param array $parameters_keyword
     *
     * @return array
     *
     * @throws Exception
     */
    public function getAllProducts(array $parameters_keyword = ['fields' => ['name', 'qty_available']]): array
    {
        return $this->execution('product.product', 'search_read', [], $parameters_keyword);
    }

    /**
     * Count all the records
     *
     * @return int
     *
     * @throws Exception
     */
    public function getCountOfProducts(): int
    {
        return $this->searchCount('product.product');
    }

    /**
     * Get a specific product from id
     *
     * @param int $id
     *
     * @return array
     *
     * @throws Exception
     */
    public function getProduct(int $id): array
    {
        $result = $this->execution('product.product', 'read', [$id]);
        if ($result) {
            return $result;
        }

        return [];
    }

    /**
     * Update the quantity of the given product
     *
     * @param int $id
     * @param int $quantity
     * @param int $locationID
     *
     * @return bool
     *
     * @throws Exception
     */
    public function updateQuantityProduct(int $id, int $quantity, int $locationID = 12): bool
    {
        $stock = $this->execution(
            'stock.change.product.qty',
            'create',
            [[
                'product_id' => $id,
                'location_id' => $locationID,
                'new_quantity' => $quantity,
            ]]
        );

        $this->execution(
            'stock.change.product.qty',
            'change_product_qty',
            [
                $stock
            ],
            []
        );

        return true;
    }
}
