<?php

namespace App\Http\Controllers\Admin;

use App\Forms\PayPalWebProfileForm;
use App\Models\PaypalWebProfile;
use App\Repositories\PaypalWebProfileRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PayPalWebProfilesController extends Controller
{
    /**
     * @var PaypalWebProfileRepository
     */
    private $repository;

    /**
     * PayPalWebProfilesController constructor.
     */
    public function __construct(PaypalWebProfileRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){

        $webProfiles = $this->repository->paginate();
        return view('admin.webProfiles.index', compact('webProfiles'));

    }

    public function create(){

        $form = \FormBuilder::create(PayPalWebProfileForm::class, [
            'url' => route('admin.web_profiles.store'),
            'method' => 'POST'
        ]);

        return view('admin.webProfiles.create', compact('form'));

    }

    public function store(Request $request){

        $form = \FormBuilder::create(PayPalWebProfileForm::class);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->create(array_except($data, 'code'));
        $request->session()->flash('message', 'Perfil PayPal criado com sucesso.');
        return redirect()->route('admin.web_profiles.index');
    }

    public function edit(PaypalWebProfile $web_profile){

        $form = \FormBuilder::create(PayPalWebProfileForm::class, [
            'url' => route('admin.web_profiles.update', ['web_profile' => $web_profile->id]),
            'method' => 'PUT',
            'model' => $web_profile
        ]);

        return view('admin.webProfiles.edit', compact('form'));

    }

    public function update(Request $request, $id){

        $form = \FormBuilder::create(PayPalWebProfileForm::class);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->update($data,$id);
        $request->session()->flash('message', 'Perfil PayPal alterado com sucesso.');
        return redirect()->route('admin.web_profiles.index');

    }

    public function show(PayPalWebProfile $web_profile){

        return view('admin.webProfiles.show', compact('web_profile'));

    }

    public function destroy(Request $request,$id){

        $this->repository->delete($id);
        $request->session()->flash('message', 'Perfil PayPal excluido com sucesso.');
        return redirect()->route('admin.web_profiles.index');
    }

}
