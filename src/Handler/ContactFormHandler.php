<?php

namespace App\Handler;

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
    private $contactHandler;

    public function __construct(
        FormFactoryInterface $formFactory,
        FlashBagInterface $flashBag,
        EntityFactory $entityFactory,
        ContactHandler $contactHandler
    ){
        $this->formFactory = $formFactory;
        $this->flashBag = $flashBag;
        $this->entityFactory = $entityFactory;
        $this->contactHandler = $contactHandler;
    }

    public function handle(Request $request)
    {
        $contact = $this->entityFactory->createContact();
        $form = $this->formFactory->create(ContactType::class, $contact);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $data = $form->getData();
                $this->contactHandler->handle($data);
                //TODO check if sending was successfull, add error if not
                $this->flashBag->add('notice', "form.success");

                return null;
            }
        }

        return $form;
    }
}
