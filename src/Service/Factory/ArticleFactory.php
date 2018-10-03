<?php

namespace App\Service\Factory;

use App\Entity\Article;

final class ArticleFactory
{
    public static function getNew(): Article
    {
        return new Article();
    }
}
