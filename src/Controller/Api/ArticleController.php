<?php

namespace App\Controller\Api;

use App\Entity\Article;
use App\Service\Application\ArticleApplication;
use App\Service\DTO\ArticleDTO;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolationList;

/**
 * @SWG\Tag(name="article")
 */
class ArticleController extends FOSRestController
{
    private $application;

    public function __construct(ArticleApplication $application)
    {
        $this->application = $application;
    }

    /**
     * @Route("/articles", name="article_post", methods={"POST"})
     *
     * @SWG\Response(
     *     response=201,
     *     description="Create an article",
     *     @Model(type=ArticleDTO::class)
     * )
     *
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
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the list of articles",
     *     @SWG\Schema(type="array", @SWG\Items(ref=@Model(type=ArticleDTO::class)))
     * )
     *
     * @Rest\QueryParam(name="page", requirements="\d+", default=1)
     * @Rest\View(statusCode=200)
     */
    public function getList(ParamFetcherInterface $paramFetcher)
    {
        return $this->application->getList(
            $paramFetcher->get('page')
        );
    }

    /**
     * @Route("/articles/{id}", name="article_get", methods={"GET"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the detail of article",
     *     @Model(type=ArticleDTO::class)
     * )
     *
     * @Rest\View(statusCode=200)
     */
    public function getOne(Article $article): ArticleDTO
    {
         return $this->application->get($article);
    }

    /**
     * @Route("/articles/{id}", name="article_put", methods={"PUT"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Update an article",
     *     @Model(type=ArticleDTO::class)
     * )
     *
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
     *
     * @SWG\Response(
     *     response=204,
     *     description="Delete an article"
     * )
     *
     * @Rest\View(statusCode=204)
     */
    public function deleteArticle(int $id)
    {
        $this->application->delete($id);
    }
}
