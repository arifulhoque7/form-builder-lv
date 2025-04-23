<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormField;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forms = Form::with('fields')->get();
        return Inertia::render('Forms/Index', [
            'forms' => $forms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Forms/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'method' => 'required|string|in:GET,POST,PUT,PATCH,DELETE',
            'action' => 'nullable|string|max:255',
            'configuration' => 'nullable|array',
            'fields' => 'required|array',
            'fields.*.type' => 'required|string',
            'fields.*.name' => 'required|string',
            'fields.*.label' => 'required|string',
            'fields.*.placeholder' => 'nullable|string',
            'fields.*.required' => 'boolean',
            'fields.*.validation_rules' => 'nullable|array',
            'fields.*.order' => 'required|integer',
            'fields.*.options' => 'nullable|array',
        ]);

        $form = Form::create([
            'title' => $validated['title'],
            'method' => $validated['method'],
            'action' => $validated['action'],
            'configuration' => $validated['configuration'] ?? null,
        ]);

        foreach ($validated['fields'] as $field) {
            $form->fields()->create($field);
        }

        return redirect()->route('forms.index')->with('success', 'Form created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        $form->load('fields');
        return Inertia::render('Forms/Show', [
            'form' => $form
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Form $form)
    {
        $form->load('fields');
        return Inertia::render('Forms/Edit', [
            'form' => $form
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Form $form)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'method' => 'required|string|in:GET,POST,PUT,PATCH,DELETE',
            'action' => 'nullable|string|max:255',
            'configuration' => 'nullable|array',
            'fields' => 'required|array',
            'fields.*.type' => 'required|string',
            'fields.*.name' => 'required|string',
            'fields.*.label' => 'required|string',
            'fields.*.placeholder' => 'nullable|string',
            'fields.*.required' => 'boolean',
            'fields.*.validation_rules' => 'nullable|array',
            'fields.*.order' => 'required|integer',
            'fields.*.options' => 'nullable|array',
        ]);

        $form->update([
            'title' => $validated['title'],
            'method' => $validated['method'],
            'action' => $validated['action'],
            'configuration' => $validated['configuration'] ?? null,
        ]);

        // Delete existing fields
        $form->fields()->delete();

        // Create new fields
        foreach ($validated['fields'] as $field) {
            $form->fields()->create($field);
        }

        return redirect()->route('forms.index')->with('success', 'Form updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->route('forms.index')->with('success', 'Form deleted successfully.');
    }

    public function updateFieldOrder(Request $request, Form $form)
    {
        $validated = $request->validate([
            'fields' => 'required|array',
            'fields.*.id' => 'required|exists:form_fields,id',
            'fields.*.order' => 'required|integer',
        ]);

        foreach ($validated['fields'] as $field) {
            FormField::where('id', $field['id'])
                ->where('form_id', $form->id)
                ->update(['order' => $field['order']]);
        }

        return response()->json(['message' => 'Field order updated successfully']);
    }
}
