<?php

namespace Rise1\Api;

interface DataProvider
{
    /**
     * @return array
     */
    public function getData(): array;
}