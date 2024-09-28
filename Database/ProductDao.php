<?php

namespace Database;

class ProductDao extends AbstractDao
{
    public function __construct()
    {
        parent::__construct("product");
    }
}