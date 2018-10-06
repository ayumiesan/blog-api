<?php

namespace App\Service\Assembler;

use App\Entity\Category;
use App\Service\DTO\CategoryDTO;
use App\Service\Factory\CategoryFactory;

final class CategoryAssembler
{
    public function read(CategoryDTO $categoryDTO, ?Category $category = null): Category
    {
        if (!$category) {
            $category = CategoryFactory::getNew();
        }

        $category->setLabel($categoryDTO->getLabel());

        return $category;
    }

    public function write(Category $category): CategoryDTO
    {
        return new CategoryDTO(
            $category->getLabel(),
            $category->getId()
        );
    }

    public function writeMultiple(array $categories): array
    {
        return array_map(function (Category $category) {
            return $this->write($category);
        }, $categories);
    }
}
