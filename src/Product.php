<?php

namespace Raynl\Bizzcloud;

class Product extends Bizzcloud
{
    /**
     * Get all products
     *
     * @param array $parameters_keyword
     * @return array
     */
    public function getAllProducts(array $parameters_keyword = []): array
    {
        return $this->execution('product.template', 'search_read', [], $parameters_keyword);
    }

    /**
     * Get a specific product from id
     *
     * @param int $id
     * @return array
     */
    public function getProduct(int $id): array
    {
        return $this->execution('product.template', 'read', [$id]);
    }
}
