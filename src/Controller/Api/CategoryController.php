<?php

namespace App\Controller\Api;


use App\Entity\Category;
use App\Service\Application\CategoryApplication;
use App\Service\DTO\CategoryDTO;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;

class CategoryController
{
    private $application;

    public function __construct(CategoryApplication $application)
    {
        $this->application = $application;
    }

    /**
     * @Route("/categories", name="categories_post", methods={"POST"})
     *
     * @ParamConverter("categoryDTO", converter="fos_rest.request_body")
     * @Rest\View(statusCode=201)
     */
    public function post(CategoryDTO $categoryDTO): CategoryDTO
    {
        return $this->application->create($categoryDTO);
    }

    /**
     * @Route("/categories/{id}", name="categories_get_one", methods={"GET"})
     *
     * @Rest\View(statusCode=200)
     */
    public function getOne(Category $category): CategoryDTO
    {
        return $this->application->get($category);
    }

    /**
     * @Route("/categories", name="categories_get_list", methods={"GET"})
     *
     * @Rest\View(statusCode=200)
     */
    public function getList(): array
    {
        return $this->application->getList();
    }

    /**
     * @Route("/categories/{id}", name="categories_put", methods={"PUT"})
     *
     * @ParamConverter("categoryDTO", converter="fos_rest.request_body")
     * @Rest\View(statusCode=200)
     */
    public function put(CategoryDTO $categoryDTO, Category $category): CategoryDTO
    {
        return $this->application->update($categoryDTO, $category);
    }

    /**
     * @Route("/categories/{id}", name="categories_delete", methods={"DELETE"})
     *
     * @Rest\View(statusCode=204)
     */
    public function delete(int $id): void
    {
        $this->application->delete($id);
    }
}
