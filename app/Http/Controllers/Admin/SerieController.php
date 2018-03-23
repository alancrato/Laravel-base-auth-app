<?php

namespace App\Http\Controllers\Admin;

use App\Models\Serie;
use App\Forms\SerieForm;
use App\Repositories\SerieRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SerieController extends Controller
{
    /**
     * @var SerieRepository
     */
    private $repository;

    /**
     * SerieController constructor.
     * @param SerieRepository $repository
     */
    public function __construct(SerieRepository $repository)
    {

        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = $this->repository->paginate();
        return view('admin.series.index', compact('series'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(SerieForm::class, [
            'url' => route('admin.series.store'),
            'method' => 'POST'
        ]);
        return view('admin.series.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(SerieForm::class);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();

        $this->repository->create($data);

        $request->session()->flash('message', 'Serie cadastrada com sucesso.');

        return redirect()->route('admin.series.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Serie $serie
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Serie $series)
    {
        return view('admin.series.show', compact('series'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Serie $series)
    {
        $form = \FormBuilder::create(SerieForm::class, [
            'url' => route('admin.series.update',['series' => $series->id]),
            'method' => 'PUT',
            'model' => $series
        ]);
        return view('admin.series.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(SerieForm::class, [
            'data' => ['id' => $id]
        ]);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $request->all();

        $this->repository->update($data,$id);

        $request->session()->flash('message', 'Serie atualizada com sucesso.');

        return redirect()->route('admin.series.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->repository->delete($id);

        $request->session()->flash('message', 'Serie excluida com sucesso.');

        return redirect()->route('admin.series.index');
    }
}
