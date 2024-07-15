<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class ChildController extends Controller
{
    use AuthorizesRequests;

    /**
     * @throws Throwable
     */
    public function index(Request $request)
    {
        // Get all children for the current user
        $query = $request->user()->children();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%$search%")
                  ->orWhere('last_name', 'like', "%$search%");
            });
        }

        $children = $query->get();

        if ($request->ajax()) {
            return view('children.partials.list', compact('children'))->render();
        }

        return view('children.index', compact('children'));
    }

    public function create()
    {
        return view('children.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'last_name'      => 'required|string|max:255',
            'first_name'     => 'required|string|max:255',
            'date_of_birth'  => 'required|date',
            'class_level_id' => 'required|exists:class_levels,id',
            'information'    => 'nullable|string',
            'special_needs'  => 'required|boolean',
            'media_consent'  => 'required|boolean',
            'school_type_id' => 'required|exists:school_types,id',
            'school_id'      => 'required|exists:schools,id',
        ]);

        $request->user()->children()->create($request->all());

        return redirect()->route('children.index')->with('success', 'Child added successfully.');
    }

    public function show(Child $child)
    {
        return $child;
    }

    public function edit(Child $child)
    {
        return view('children.edit', compact('child'));
    }

    public function update(Request $request, Child $child)
    {
        $request->validate([
            'last_name'      => 'required|string|max:255',
            'first_name'     => 'required|string|max:255',
            'date_of_birth'  => 'required|date',
            'class_level_id' => 'required|exists:class_levels,id',
            'information'    => 'nullable|string',
            'special_needs'  => 'required|boolean',
            'media_consent'  => 'required|boolean',
            'school_type_id' => 'required|exists:school_types,id',
            'school_id'      => 'required|exists:schools,id',
        ]);

        $child->update($request->all());

        return redirect()->route('children.index')->with('success', 'Child updated successfully.');
    }

    public function destroy(Request $request, Child $child): RedirectResponse
    {
        $request->validateWithBag('childDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $this->authorize('delete', $child);

        $child->delete();

        return redirect()->route('children.index')->with('success', 'Child deleted successfully.');
    }
}
