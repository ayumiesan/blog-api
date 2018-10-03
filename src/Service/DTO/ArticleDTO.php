<?php

namespace App\Service\DTO;

use Symfony\Component\Validator\Constraints as Assert;

final class ArticleDTO
{
    private $id;

    /**
     * @Assert\NotBlank
     */
    private $title;

    /**
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
