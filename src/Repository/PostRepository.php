<?php

namespace App\Repository;

use Attributes\TargetEntity;
use Core\Repository\Repository;
use App\Entity\Post;

#[TargetEntity(entityName: Post::class)]
class PostRepository extends Repository
{
public function save(Post $post): int
{
    $query = $this->pdo->prepare("INSERT INTO $this->tableName (title, content) VALUES(:title, :content)");
    $query->execute([
        'title' => $post->getTitle(),
        'content' => $post->getContent()
    ]);

    $id = $this->pdo->lastInsertId();
    return $id;
}

public function edit(Post $post): int
{
    $query = $this->pdo->prepare("UPDATE $this->tableName SET title = :title,  content = :content WHERE id = :id");
    $query->execute([
        'title' => $post->getTitle(),
        'content' => $post->getContent(),
        'id' => $post->getId()
    ]);
    return $post->getId();
}
}