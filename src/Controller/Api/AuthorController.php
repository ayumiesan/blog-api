<?php

namespace App\Controller\Api;

use App\Entity\Author;
use App\Service\Application\AuthorApplication;
use App\Service\DTO\AuthorDTO;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController
{
    private $application;

    public function __construct(AuthorApplication $application)
    {
        $this->application = $application;
    }

    /**
     * @Route("/authors", name="author_post", methods={"POST"})
     *
     * @ParamConverter("authorDTO", converter="fos_rest.request_body")
     * @Rest\View(statusCode=201)
     */
    public function post(AuthorDTO $authorDTO): AuthorDTO
    {
        return $this->application->create($authorDTO);
    }

    /**
     * @Route("/authors/{id}", name="author_get", methods={"GET"})
     *
     * @Rest\View(statusCode=200)
     */
    public function getOne(Author $author): AuthorDTO
    {
        return $this->application->get($author);
    }

    /**
     * @Route("/authors", name="author_get_list", methods={"GET"})
     *
     * @Rest\View(statusCode=200)
     */
    public function getList(): array
    {
        return $this->application->getList();
    }

    /**
     * @Route("/authors/{id}", name="author_put", methods={"PUT"})
     *
     * @ParamConverter("authorDTO", converter="fos_rest.request_body")
     * @Rest\View(statusCode=200)
     */
    public function put(AuthorDTO $authorDTO, Author $author): AuthorDTO
    {
        return $this->application->update($authorDTO, $author);
    }

    /**
     * @Route("/authors/{id}", name="author_delete", methods={"DELETE"})
     *
     * @Rest\View(statusCode=204)
     */
    public function delete(int $id): void
    {
        $this->application->delete($id);
    }
}
