<?php

namespace App\Database;

use ArrayIterator;
use Countable;
use IteratorAggregate;

class DatabaseCollection implements IteratorAggregate, Countable
{
    /**
     * @var DatabaseModel[]
     */
    private array $items;

    /**
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * @param DatabaseModel $item
     *
     * @return void
     */
    public function add(DatabaseModel $item): void
    {
        $this->items[] = $item;
    }

    /**
     * @param DatabaseModel $item
     *
     * @return void
     */
    public function remove(DatabaseModel $item): void
    {
        $index = array_search($item, $this->items, true);
        if ($index !== false) {
            unset($this->items[$index]);
        }
    }

    /**
     * @param int $key
     *
     * @return mixed
     */
    public function get(int $key): mixed
    {
        return $this->items[$key] ?? null;
    }

    /**
     * @return array|DatabaseModel[]
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * @inheritDoc
     *
     * @return ArrayIterator<int, DatabaseModel>
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }
}