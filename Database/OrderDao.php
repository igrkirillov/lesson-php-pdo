<?php

namespace Database;

class OrderDao extends AbstractDao
{
    public function __construct()
    {
        parent::__construct("order");
    }
}