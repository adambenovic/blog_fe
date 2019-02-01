<?php

namespace App\Decorator;

class ContactDecorator
{
    public function decorate(array $data)
    {
        return [
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'],
            'body' => $data['body']
        ];
    }
}
