<?php

namespace App\Controller\Api;

use App\Entity\Article;
use App\Service\Application\ArticleApplication;
use App\Service\DTO\ArticleDTO;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolationList;

class ArticleController extends FOSRestController
{
    private $application;

    public function __construct(ArticleApplication $application)
    {
        $this->application = $application;
    }

    /**
     * @Route("/articles", name="article_post", methods={"POST"})
     * @ParamConverter("articleDTO", converter="fos_rest.request_body")
     * @Rest\View(statusCode=201)
     */
    public function post(ArticleDTO $articleDTO, ConstraintViolationList $violationList)
    {
        if (count($violationList)) {
            return $this->view($violationList, Response::HTTP_BAD_REQUEST);
        }

        return $this->application->add($articleDTO);
    }

    /**
     * @Route("/articles", name="article_get_list", methods={"GET"})
     * @Rest\View(statusCode=200)
     */
    public function getList()
    {
        return $this->application->getList();
    }

    /**
     * @Route("/articles/{id}", name="article_get", methods={"GET"})
     * @Rest\View(statusCode=200)
     */
    public function getOne(Article $article): ArticleDTO
    {
         return $this->application->get($article);
    }

    /**
     * @Route("/articles/{id}", name="article_put", methods={"PUT"})
     * @ParamConverter("articleDTO", converter="fos_rest.request_body")
     * @Rest\View(statusCode=200)
     */
    public function put(ArticleDTO $articleDTO, Article $article, ConstraintViolationList $violationList)
    {
        if (count($violationList)) {
            return $this->view($violationList, Response::HTTP_BAD_REQUEST);
        }

        return $this->application->save($articleDTO, $article);
    }

    /**
     * @Route("/articles/{id}", name="article_delete", methods={"DELETE"})
     * @Rest\View(statusCode=204)
     */
    public function deleteArticle(int $id)
    {
        $this->application->delete($id);
    }
}
