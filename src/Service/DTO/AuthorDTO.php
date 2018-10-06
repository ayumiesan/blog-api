<?php

namespace App\Service\DTO;

use Swagger\Annotations as SWG;
use Symfony\Component\Validator\Constraints as Assert;

final class AuthorDTO
{
    /**
     * @SWG\Property(readOnly=true, description="The unique identifer of the author", example={1})
     */
    private $id;

    /**
     * @SWG\Property(maxLength=255, description="The first name of the author", example={"Henry"})
     * @Assert\NotBlank
     */
    private $firstName;

    /**
     * @SWG\Property(maxLength=255, description="The last name of the author", example={"Swan"})
     * @Assert\NotBlank
     */
    private $lastName;

    /**
     * @SWG\Property(type="text", description="The biography of the author", example={"My name is Henry Swan"})
     * @Assert\NotBlank
     */
    private $biography;

    public function __construct(string $firstName, string $lastName, string $biography, ?int $id = null)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->biography = $biography;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBiography(): string
    {
        return $this->biography;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }
}
