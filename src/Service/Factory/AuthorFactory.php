<?php

namespace App\Service\Factory;

use App\Entity\Author;

final class AuthorFactory
{
    public static function getNew(): Author
    {
        return new Author();
    }
}
