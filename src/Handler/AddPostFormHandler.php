<?php

namespace App\Handler;

use App\Factory\EntityFactory;
use App\Form\BlogPostFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class AddPostFormHandler
{
    private $formFactory;
    private $factory;

    public function __construct(
        FormFactoryInterface $formFactory,
        EntityFactory $factory
    ){
        $this->formFactory = $formFactory;
        $this->factory = $factory;
    }

    public function handle(Request $request)
    {
        $blog = $this->factory->createBlogPost();
        $form = $this->formFactory->create(BlogPostFormType::class, $blog);

        if ($request->getMethod() == 'POST')
        {
            $form->handleRequest($request);

            if ($form->isValid())
            {
                //TODO form handler
                return null;
            }
        }

        return $form;
    }
}
