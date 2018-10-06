<?php

namespace App\Service\Application;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Service\Assembler\CategoryAssembler;
use App\Service\DTO\CategoryDTO;
use Doctrine\ORM\EntityManagerInterface;

class CategoryApplication
{
    private $em;
    private $repository;
    private $assembler;

    public function __construct(EntityManagerInterface $em, CategoryRepository $repository, CategoryAssembler $assembler)
    {
        $this->em = $em;
        $this->repository = $repository;
        $this->assembler = $assembler;
    }

    public function create(CategoryDTO $categoryDTO): CategoryDTO
    {
        $category = $this->assembler->read($categoryDTO);
        $this->em->persist($category);
        $this->em->flush();

        return $this->assembler->write($category);
    }

    public function get(Category $category): CategoryDTO
    {
        return $this->assembler->write($category);
    }

    public function getList(): array
    {
        $categories = $this->repository->findAll();

        return $this->assembler->writeMultiple($categories);
    }

    public function update(CategoryDTO $categoryDTO, Category $category): CategoryDTO
    {
        $category = $this->assembler->read($categoryDTO, $category);
        $this->em->persist($category);
        $this->em->flush();

        return $this->assembler->write($category);
    }

    public function delete(int $id): void
    {
        $category = $this->repository->find($id);
        if ($category) {
            $this->em->remove($category);
            $this->em->flush();
        }
    }
}
