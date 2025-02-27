<?php

namespace App\Entity;


use Attributes\TargetRepository;
use Core\Attributes\Table;
use App\Repository\PostRepository;

#[Table(name:'posts')]
#[TargetRepository(repoName: PostRepository::class)]
class Post
{
    private int $id;
    private string $title;
    private string $content;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }


}