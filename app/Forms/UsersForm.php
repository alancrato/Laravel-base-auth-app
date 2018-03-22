<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class UsersForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text')
            ->add('email', 'email');
    }
}
