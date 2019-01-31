<?php

namespace App\Factory;

use App\Entity\Comment;
use App\Entity\Contact;
use Symfony\Component\Security\Core\Security;
use App\Entity\Blog;

class EntityFactory
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @return Blog new Blog object with Author set
     */
    public function createBlogPost(): Blog
    {
        $blog = new Blog();
        $blog->setAuthor($this->security->getUser());

        return $blog;
    }

    public function createComment(): Comment
    {
        return new Comment();
    }

    /**
     * @return Contact new Contact object
     */
    public function createContact(): Contact
    {
        $contact = new Contact();

        return $contact;
    }
}
