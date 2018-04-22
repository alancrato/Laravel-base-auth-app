<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class VideoUploadForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('thumb', 'file', [
                'require' => false,
                'label' => 'Thumbnail',
                'rules' => 'image|max:1024'
            ]);

        $this
            ->add('file', 'file', [
                'require' => false,
                'label' => 'Arquivo de Video',
                'rules' => 'mimetypes:video/mp4'
            ]);
    }
}