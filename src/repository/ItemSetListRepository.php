<?php


namespace Rise1\Repository;


use Rise1\Api\ItemSetListRepositoryInterface;
use Rise1\Api\PriceCalculatedInterface;

class ItemSetListRepository implements ItemSetListRepositoryInterface
{
    /** @var array $itemList */
    private $itemList;

    /**
     * ItemSetListRepository constructor.
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        $this->itemList = [];
    }

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getItemList(): array
    {
        return $this->itemList;
    }

    /**
     * @codeCoverageIgnore
     * @param PriceCalculatedInterface $item
     */
    public function addItem(PriceCalculatedInterface $item): void
    {
        $this->itemList[] = $item;
    }
}