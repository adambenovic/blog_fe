<?php

namespace App\Entity;

class Comment
{
    public function __construct()
    {
    }

    private $comment;

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }
}
