<?php

namespace App\Service\DTO;

use Swagger\Annotations as SWG;
use Symfony\Component\Validator\Constraints as Assert;

final class CategoryDTO
{
    /**
     * @SWG\Property(readOnly=true, description="The unique identifer of the category", example={1})
     */
    private $id;

    /**
     * @SWG\Property(readOnly=true, description="The label of the category", example={"Category1"})
     * @Assert\NotBlank
     */
    private $label;

    public function __construct(string $label, ?int $id = null)
    {
        $this->id = $id;
        $this->label = $label;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): string
    {
        return $this->label;
    }
}
