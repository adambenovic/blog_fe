<?php

namespace App\Decorator;


use Symfony\Component\Form\FormInterface;

class ContactDecorator
{
    public function decorate(FormInterface $form)
    {
        $data = $form->getData();
        return [
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'],
            'body' => $data['body']
        ];
    }

}