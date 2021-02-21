<?php

namespace Rise1\Api;

interface ItemSetListRepositoryInterface
{
    /**
     * @return array
     */
    public function getItemList(): array;

    /**
     * @param PriceCalculatedInterface $item
     */
    public function addItem(PriceCalculatedInterface $item): void;
}