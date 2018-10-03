<?php

namespace App\Service\Assembler;

use App\Entity\Article;
use App\Service\DTO\ArticleDTO;
use App\Service\Factory\ArticleFactory;

final class ArticleAssembler
{
    public function read(ArticleDTO $articleDTO, ?Article $article = null): Article
    {
        if (!$article) {
            $article = ArticleFactory::getNew();
        }

        $article->setTitle($articleDTO->getTitle());
        $article->setContent($articleDTO->getContent());

        return $article;
    }

    public function write(Article $article): ArticleDTO
    {
        return new ArticleDTO(
            $article->getTitle(),
            $article->getContent(),
            $article->getId()
        );
    }

    public function writeMultiple($articles): array
    {
        return array_map(function (Article $article) {
            return $this->write($article);
        }, $articles);
    }
}
