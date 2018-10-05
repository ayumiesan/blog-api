<?php

namespace App\Service\DTO;

use Swagger\Annotations as SWG;
use Symfony\Component\Validator\Constraints as Assert;

final class ArticleDTO
{
    /**
     * @SWG\Property(readOnly=true, description="The unique identifier of the article.", example={1})
     */
    private $id;

    /**
     * @SWG\Property(maxLength=255, description="The title of the article.", example={"Title of article"})
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @SWG\Property(type="text", description="The content of the article.", example={"Content of article"})
     * @Assert\NotBlank
     */
    private $content;

    public function __construct(string $title, string $content, ?int $id = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
