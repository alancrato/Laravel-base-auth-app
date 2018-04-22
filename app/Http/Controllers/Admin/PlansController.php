<?php

namespace App\Http\Controllers\Admin;

use App\Forms\PlanForm;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Repositories\PlanRepository;
use App\Http\Controllers\Controller;

class PlansController extends Controller
{
    /**
     * @var PlanRepository
     */
    private $repository;

    /**
     * PlansController constructor.
     */
    public function __construct(PlanRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){

        $plans = $this->repository->paginate();
        return view('admin.plans.index', compact('plans'));

    }

    public function create(){

        $form = \FormBuilder::create(PlanForm::class, [
           'url' => route('admin.plans.store'),
           'method' => 'POST'
        ]);

        return view('admin.plans.create', compact('form'));

    }

    public function store(Request $request){

        $form = \FormBuilder::create(PlanForm::class);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->create(array_except($data, 'code'));
        $request->session()->flash('message', 'Plano criado com sucesso.');
        return redirect()->route('admin.plans.index');
    }

    public function edit(Plan $plan){

        $form = \FormBuilder::create(PlanForm::class, [
            'url' => route('admin.plans.update', ['plan' => $plan->id]),
            'method' => 'PUT',
            'model' => $plan
        ]);

        return view('admin.plans.edit', compact('form'));

    }

    public function update(Request $request, $id){

        $form = \FormBuilder::create(PlanForm::class);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->update($data,$id);
        $request->session()->flash('message', 'Plano alterado com sucesso.');
        return redirect()->route('admin.plans.index');

    }

    public function show(Plan $plan){

        return view('admin.plans.show', compact('plan'));

    }

    public function destroy(Request $request,$id){

        $this->repository->delete($id);
        $request->session()->flash('message', 'Plano excluido com sucesso.');
        return redirect()->route('admin.plans.index');
    }

}
