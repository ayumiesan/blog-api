<?php

namespace App\Service\Assembler;

use App\Entity\Author;
use App\Service\DTO\AuthorDTO;
use App\Service\Factory\AuthorFactory;

final class AuthorAssembler
{
    public function read(AuthorDTO $authorDTO, ?Author $author = null): Author
    {
        if (!$author) {
            $author = AuthorFactory::getNew();
        }

        $author->setFirstName($authorDTO->getFirstName());
        $author->setLastName($authorDTO->getLastName());
        $author->setBiography($authorDTO->getBiography());

        return $author;
    }

    public function write(Author $author): AuthorDTO
    {
        return new AuthorDTO(
            $author->getFirstName(),
            $author->getLastName(),
            $author->getBiography(),
            $author->getId()
        );
    }

    public function writeMultiple(array $authors): array
    {
        return array_map(function (Author $author) {
            return $this->write($author);
        }, $authors);
    }
}
