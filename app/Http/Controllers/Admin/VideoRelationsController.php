<?php

namespace App\Http\Controllers\Admin;

use App\Forms\VideoRelationForm;
use App\Models\Video;
use App\Repositories\VideoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\Form;

class VideoRelationsController extends Controller
{
    /**
     * @var VideoRepository
     */
    private $repository;

    /**
     * VideoRelationsController constructor.
     */
    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Video $video)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(VideoRelationForm::class, [
            'url' => route('admin.videos.relations.store',['video' => $video->id]),
            'method'  => 'POST',
            'model' => $video
        ]);

        return view('admin.videos.relation', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(VideoRelationForm::class);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->update($data, $id);
        $request->session()->flash('message', 'Video alterado com sucesso.');
        return redirect()->route('admin.videos.relations.create',['video' => $id]);
    }

}
