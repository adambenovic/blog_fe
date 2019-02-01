<?php

namespace App\Handler;

use App\Entity\Blog;
use App\Factory\EntityFactory;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class CommentFormHandler
{
    private $formFactory;
    private $flashBag;
    private $factory;
    private $commentsHandler;

    public function __construct(
        FormFactoryInterface $formFactory,
        FlashBagInterface $flashBag,
        EntityFactory $factory,
        CommentsHandler $commentsHandler
    ){
        $this->formFactory = $formFactory;
        $this->flashBag = $flashBag;
        $this->factory = $factory;
        $this->commentsHandler = $commentsHandler;
    }

    public function handle(Request $request, int $blogid)
    {
        $comment = $this->factory->createComment();
        $form = $this->formFactory->create(CommentType::class, $comment);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $response = $this->commentsHandler->postComment($comment, $blogid);
                if($response == null)
                    $this->flashBag->add('error', 'comment.login');

                return null;
            }
        }

        return $form;
    }
}