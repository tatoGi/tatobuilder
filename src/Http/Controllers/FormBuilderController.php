<?php

namespace Tatobuilder\FormBuilder\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Tatobuilder\FormBuilder\Models\Form;
use Tatobuilder\FormBuilder\Models\FormField;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormBuilderController extends Controller
{
    public function index(Request $request)
    {
        $forms = Form::all();

        if ($request->has('name')) {
            $forms->where('name', 'LIKE', '%' . $request->get('name') . '%');
        }

        return view('formbuilder::admin.forms.index', compact('forms'));
    }

    public function create()
    {
        $formTypes = $this->formTypes();
        return view('formbuilder::admin.forms.create', compact(['formTypes']));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'title' => 'required',
            'email' => 'required',
        ]);

        // Form Data
        $formData = [
            'name' => $data['name'],
            'title' => $data['title'],
            'email' => $data['email'],
        ];

        $form = Form::create($formData);

        if (isset($request['n_fields'])) {

            $formFieldsData = [];
            foreach ($request['n_fields'] as $key => $value) {
                $formFieldsData[$key] = [
                    'title' => $value['name'],
                    'type' => $value['type_id'],
                    'validation' => json_encode($value['validation']),
                    'data' => json_encode(['options' => $value['options'] ?? null]),
                    'form_id' => $form->id
                ];
            }

            FormField::insert($formFieldsData);
        }
        return Redirect::route('forms.index', [app()->getLocale()])->with('success', 'Saved successfully');
    }

    public function edit($id)
    {
        $form = Form::where('id', $id)->first();
        return view('formbuilder::admin.forms.update', compact(['form']));
    }

    public function update($id, Request $request)
    {
        $values = $request->all();

        Validator::validate($values, [
            'name' => 'required',
            'title' => 'required',
            'email' => 'required',
        ]);

        FormField::where('form_id', $id)->delete();

        if (isset($values['n_fields'])) {
            foreach ($values['n_fields'] as $key => $value) {
                $formFieldsData = [
                    'title' => $value['name'],
                    'type' => $value['type_id'],
                    'validation' => json_encode($value['validation']),
                    'data' => json_encode(['options' => $value['options'] ?? null]),
                    'form_id' => $id
                ];
                FormField::insert($formFieldsData);
            }
        }
        Form::find($id)->update($values);

        return redirect()->route('forms.index', [app()->getLocale()])->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        $form = Form::where('id', $id)->first();
        FormField::where('form_id', $form->id)->delete();
        $form->delete();
        DB::commit();

        return Redirect::route('forms.index', [app()->getLocale()])->with('delete', 'Deleted successfully');
    }
}
