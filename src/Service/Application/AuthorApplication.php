<?php

namespace App\Service\Application;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use App\Service\Assembler\AuthorAssembler;
use App\Service\DTO\AuthorDTO;
use Doctrine\ORM\EntityManagerInterface;

class AuthorApplication
{
    private $em;
    private $repository;
    private $assembler;

    public function __construct(EntityManagerInterface $em, AuthorRepository $repository, AuthorAssembler $assembler)
    {
        $this->em = $em;
        $this->repository = $repository;
        $this->assembler = $assembler;
    }

    public function create(AuthorDTO $authorDTO): AuthorDTO
    {
        $author = $this->assembler->read($authorDTO);
        $this->em->persist($author);
        $this->em->flush();

        return $this->assembler->write($author);
    }

    public function get(Author $author): AuthorDTO
    {
        return $this->assembler->write($author);
    }

    public function getList()
    {
        $authors = $this->repository->findAll();

        return $this->assembler->writeMultiple($authors);
    }

    public function update(AuthorDTO $authorDTO, Author $author): AuthorDTO
    {
        $author = $this->assembler->read($authorDTO, $author);
        $this->em->persist($author);
        $this->em->flush();

        return $this->assembler->write($author);
    }

    public function delete(int $id)
    {
        $author = $this->repository->find($id);
        if ($author) {
            $this->em->remove($author);
            $this->em->flush();
        }
    }
}
