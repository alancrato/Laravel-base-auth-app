<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Models\Serie;

class VideoForm extends Form
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
            ->add('serie_id', 'entity', [
                'class' => Serie::class,
                'property' => 'name',
                'empty_value' => 'Selecione a série',
                'label' => 'Série',
                'rules' => 'nullable|exists:series,id'
            ])
            ->add('content', 'text',[
                'rules' => 'min:3'
            ])
            ->add('url', 'text',[
                'rules' => 'required'
            ]);
    }
}
