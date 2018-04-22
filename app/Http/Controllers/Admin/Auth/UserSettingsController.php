<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Forms\UserSettingsForm;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserSettingsController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function edit(){

        $form = \FormBuilder::create(UserSettingsForm::class, [
            'url' => route('admin.user_settings.update'),
            'method'  => 'PUT'
        ]);

        return view('admin.auth.setting', compact('form'));
    }

    public function update(Request $request){

        /** @var Form $form */
        $form = \FormBuilder::create(UserSettingsForm::class);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->update($data,\Auth::user()->id);
        $request->session()->flash('message', 'Senha alterada com sucesso');
        return redirect()->route('admin.user_settings.edit');
    }
}
