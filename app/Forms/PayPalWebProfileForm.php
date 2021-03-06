<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class PayPalWebProfileForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'label' => 'Nome',
                'rules' => 'required|max:255'
            ])
            ->add('logo_url', 'text', [
                'name' => 'Logo Url',
                'rules' => 'required|url|max:255'
            ]);

    }

}