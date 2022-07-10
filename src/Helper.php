<?php

namespace Base;

class Helper
{
    public function hashPassword(string $password)
    {
        return sha1(SALT . $password);
    }
}
