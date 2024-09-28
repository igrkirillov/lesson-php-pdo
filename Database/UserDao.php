<?php

namespace Database;

class UserDao extends AbstractDao
{
    public function __construct()
    {
        parent::__construct("user");
    }
}