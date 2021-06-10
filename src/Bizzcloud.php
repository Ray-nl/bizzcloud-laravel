<?php

namespace Raynl\Bizzcloud;

use Ripcord\Providers\Laravel\Ripcord;

class Bizzcloud extends Ripcord
{
    /**
     * Bizzcloud constructor.
     *
     * @throws \ErrorException
     */
    public function __construct()
    {
        // Check if ENV files exists it not exsits throw error
        if (env('BIZZ_URL') == null && env('BIZZ_URL') == '') {
            throw new \ErrorException('Bizzcloud URL is not set');
        }

        if (env('BIZZ_DB') == null && env('BIZZ_DB') == '') {
            throw new \ErrorException('Bizzcloud DATABASE is not set');
        }

        if (env('BIZZ_USERNAME') == null && env('BIZZ_USERNAME') == '') {
            throw new \ErrorException('Bizzcloud USERNAME is not set');
        }

        if (env('BIZZ_PASSWORD') == null && env('BIZZ_PASSWORD') == '') {
            throw new \ErrorException('Bizzcloud PASSWORD is not set');
        }

        // Set configuration for Bizzcloud
        $config = [
            'url' => config('bizzcloud.url'),
            'db' => config('bizzcloud.db'),
            'user' => config('bizzcloud.username'),
            'password' => config('bizzcloud.password'),
        ];

        parent::__construct($config);
    }

    /**
     * Execute
     *
     * @param string $model
     * @param string $method
     * @param array $parameters_position
     * @param array $parameters_keyword
     */
    public function execution(string $model, string $method, array $parameters_position, array $parameters_keyword = [])
    {
        $result = $this->client->execute_kw(
            $this->db,
            $this->uid,
            $this->password,
            $model,
            $method,
            $parameters_position,
            $parameters_keyword,
        );

        if ($result == null) {
            return [];
        }

        return $result;
    }

    /**
     * Get the fields of a model
     *
     * @param string $model
     * @param array|string[] $attributes
     *
     * @return array
     */
    public function getFields(string $model, array $attributes = ['string', 'help', 'type']): array
    {
        return $this->execution($model, 'fields_get', [], ['attributes' => $attributes]);
    }

    /**
     * Takes a mandatory domain filter (possibly empty),
     * and returns the database identifiers of all records matching the filter.
     *
     * @param string $model
     * @param string $method
     * @param array $search
     *
     * @return array
     */
    public function search(string $model, array $search = [[]], int $offset = null, int $limit = null): array
    {
        return $this->execution($model, 'search', $search, ['offset' => $offset, 'limit' => $limit]);
    }

    /**
     * Takes a mandatory domain filter (possibly empty),
     * and returns the number of records of the matching query.
     *
     * @param string $model
     * @param array $search
     *
     * @return int
     */
    public function searchCount(string $model, array $search = [[]]): int
    {
        return $this->execution($model, 'search_count', $search);
    }

    /**
     * Fetch all the fields that the current user can read
     *
     * @param string $model
     * @param array $ids
     * @param array $parameters_keyword
     *
     * @return array
     */
    public function read(string $model, array $ids, array $parameters_keyword = []): array
    {
        return $this->execution($model, 'read', $ids, $parameters_keyword);
    }

    /**
     * Because it is a very common task, BizzCloud provides a search_read() shortcut which as its name suggests is
     * equivalent to a search() followed by a read(), but avoids having to perform two requests and keep ids around.
     * Its arguments are similar to search()‘s, but it can also take a list of fields (like read(),
     * if that list is not provided it will fetch all fields of matched records)
     *
     * @param string $model
     * @param array $search
     * @param array $parameters_keyword
     *
     * @return array
     */
    public function searchAndRead(string $model, array $search, array $parameters_keyword = []): array
    {
        return $this->execution($model, 'search_read', $search, $parameters_keyword);
    }

    /**
     * Records of a model are created using create(). The method will create a single record and return its database identifier.
     * Create() takes a mapping of fields to values, used to initialize the record.
     * For any field which has a default value and is not set through the mapping argument, the default value will be used.
     *
     * Date, Datatime and Binary use the string values
     *
     * @param string $model
     * @param $values
     *
     * @return array
     */
    public function create(string $model, $values): array
    {
        return $this->execution($model, 'create', [$values]);
    }

    /**
     * Records can be updated using write(), it takes a list of records to update and a mapping of updated fields to values similar to create().
     * Multiple records can be updated simultanously, but they will all get the same values for the fields being set.
     * It is not currently possible to perform “computed” updates (where the value being set depends on an existing value of a record).
     *
     * @param string $model
     * @param int $id
     * @param array $values
     *
     * @return array
     */
    public function update(string $model, int $id, array $values): array
    {
        return $this->execution($model, 'write', [$id], [$values]);
    }

    /**
     * Records can be deleted in bulk by providing their ids.
     *
     * @param string $model
     * @param array $ids
     *
     * @return array
     */
    public function delete(string $model, array $ids): array
    {
        return $this->execution($model, 'unlink', $ids, []);
    }
}
