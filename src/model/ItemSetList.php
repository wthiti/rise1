<?php


namespace Rise1\Model;


use Rise1\Api\ItemSetListRepositoryInterface;
use Rise1\Api\PriceCalculatedInterface;

class ItemSetList implements PriceCalculatedInterface
{
    private $itemSetListRepository;

    /**
     * ItemSetList constructor.
     * @param ItemSetListRepositoryInterface $itemSetListRepository
     * @codeCoverageIgnore
     */
    public function __construct(ItemSetListRepositoryInterface $itemSetListRepository)
    {
        $this->itemSetListRepository = $itemSetListRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function getCalculatedPrice(): float
    {
        $items = $this->itemSetListRepository->getItemList();
        /** @var PriceCalculatedInterface $item */
        return array_reduce($items, function($acc, $item) {
            return $acc + $item->getCalculatedPrice();
        }, 0.0);
    }

    /**
     * @param PriceCalculatedInterface $itemSet
     */
    public function addItemSet(PriceCalculatedInterface $itemSet)
    {
        $this->itemSetListRepository->addItem($itemSet);
    }
}