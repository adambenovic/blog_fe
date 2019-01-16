<?php

namespace App\Handler;

use App\Decorator\ContactDecorator;
use App\Factory\EntityFactory;
use App\Form\ContactType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class ContactFormHandler
{
    private $formFactory;
    private $flashBag;
    private $entityFactory;
    private $contactDecorator;
    private $contactHandler;

    public function __construct(
        FormFactoryInterface $formFactory,
        FlashBagInterface $flashBag,
        EntityFactory $entityFactory,
        ContactDecorator $contactDecorator,
        ContactHandler $contactHandler
    ){
        $this->formFactory = $formFactory;
        $this->flashBag = $flashBag;
        $this->entityFactory = $entityFactory;
        $this->contactDecorator = $contactDecorator;
        $this->contactHandler = $contactHandler;
    }

    public function handle(Request $request)
    {
        $contact = $this->entityFactory->createContact();
        $form = $this->formFactory->create(ContactType::class, $contact);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $data = $this->contactDecorator->decorate($form);
                $this->contactHandler->handle($data);

                $this->flashBag->add('notice', "form.success");

                return null;
            }
        }

        return $form;
    }
}