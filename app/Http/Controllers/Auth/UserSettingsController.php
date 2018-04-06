<?php

namespace App\Http\Controllers\Auth;

use App\Repositories\UserRepository;
use App\Forms\UserSettingsForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserSettingsController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;


    /**
     * UserSettingsController constructor.
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function edit()
    {
        /** @var Form $form */
        $form = \FormBuilder::create(UserSettingsForm::class, [
            'url' => route('user.update'),
            'method' => 'PUT'
        ]);

        return view('auth.setting', compact('form'));
    }

    public function update(Request $request)
    {
        $form = \FormBuilder::create(UserSettingsForm::class);

        if(!$form->isValid()){
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->update($data,\Auth::user()->id);
        $request->session()->flash('message', 'Senha alterada com sucesso!');
        return redirect()->route('user.edit');
    }
}
