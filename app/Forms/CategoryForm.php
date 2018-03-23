<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class CategoryForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text',[
                'rules' => 'required|min:3'
            ])
            ->add('description', 'text',[
                'rules' => 'min:3'
            ])
            ->add('url', 'text',[
                'rules' => 'required'
            ]);
    }
}
