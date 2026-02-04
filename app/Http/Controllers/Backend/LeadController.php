<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;

class LeadController extends Controller
{
    /**
     * Display a listing of leads
     */
    public function index()
    {
        $leads = Lead::latest()->paginate(20);
        return view('backend.leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new lead
     */
    public function create()
    {
        return view('backend.leads.create');
    }

    /**
     * Store a newly created lead
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        Lead::create($request->all());

        return redirect()
            ->route('admin.leads.index')
            ->with('success', 'Lead created successfully.');
    }

    /**
     * Display the specified lead
     */
    public function show($id)
    {
        $lead = Lead::findOrFail($id);
        return view('backend.leads.show', compact('lead'));
    }

    /**
     * Show the form for editing the specified lead
     */
    public function edit($id)
    {
        $lead = Lead::findOrFail($id);
        return view('backend.leads.edit', compact('lead'));
    }

    /**
     * Update the specified lead
     */
    public function update(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $lead->update($request->all());

        return redirect()
            ->route('admin.leads.index')
            ->with('success', 'Lead updated successfully.');
    }

    /**
     * Remove the specified lead
     */
    public function destroy($id)
    {
        Lead::findOrFail($id)->delete();

        return redirect()
            ->route('admin.leads.index')
            ->with('success', 'Lead deleted successfully.');
    }

    /**
     * Change lead status (AJAX)
     */
    public function changeStatus(Request $request)
    {
        $lead = Lead::findOrFail($request->id);
        $lead->status = $request->status;
        $lead->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    }
}
