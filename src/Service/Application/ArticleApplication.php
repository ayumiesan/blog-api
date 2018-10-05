<?php

namespace App\Service\Application;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Service\Assembler\ArticleAssembler;
use App\Service\DTO\ArticleDTO;
use Doctrine\ORM\EntityManagerInterface;

final class ArticleApplication
{
    private $em;
    private $repository;
    private $assembler;

    public function __construct(EntityManagerInterface $em, ArticleRepository $repository, ArticleAssembler $assembler)
    {
        $this->em = $em;
        $this->repository = $repository;
        $this->assembler = $assembler;
    }

    public function add(ArticleDTO $articleDTO): ArticleDTO
    {
        $article = $this->assembler->read($articleDTO);

        $this->em->persist($article);
        $this->em->flush();

        return $this->assembler->write($article);
    }

    public function get(Article $article): ArticleDTO
    {
        return $this->assembler->write($article);
    }

    public function getList(int $page): array
    {
        return $this->assembler->writeMultiple(
            iterator_to_array(
                $this->repository->getList($page)
                ->getCurrentPageResults()
            )
        );
    }

    public function save(ArticleDTO $articleDTO, Article $article): ArticleDTO
    {
        $article = $this->assembler->read($articleDTO, $article);

        $this->em->persist($article);
        $this->em->flush();

        return $this->assembler->write($article);
    }

    public function delete(int $id): void
    {
        $article = $this->repository->find($id);
        if ($article) {
            $this->em->remove($article);
            $this->em->flush();
        }
    }
}
