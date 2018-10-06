<?php

namespace App\Service\Factory;

use App\Entity\Category;

final class CategoryFactory
{
    public static function getNew(): Category
    {
        return new Category();
    }
}
