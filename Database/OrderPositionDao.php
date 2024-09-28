<?php

namespace Database;

class OrderPositionDao extends AbstractDao
{
    public function __construct()
    {
        parent::__construct("order_position");
    }
}