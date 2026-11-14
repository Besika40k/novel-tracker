<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NovelController extends Controller
{
    /**
     * The list, with search, the status filter and pagination.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->query('search');
        $selectedStatus = $request->query('status');

        // One query that collects conditions, so search and filter work together.
        $query = Novel::query();

        if ($searchTerm) {
            // The inner group keeps "title OR author" in brackets,
            // otherwise the orWhere would cancel the status filter.
            $query->where(function ($group) use ($searchTerm) {
                $group->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('author', 'like', "%{$searchTerm}%");
            });
        }

        if ($selectedStatus) {
            $query->where('status', $selectedStatus);
        }

        // withQueryString keeps ?search=...&status=... on the page links.
        $novels = $query->orderBy('title')->paginate(10)->withQueryString();

        return view('novels.index', [
            'novels' => $novels,
            'searchTerm' => $searchTerm,
            'selectedStatus' => $selectedStatus,
            'statuses' => Novel::STATUSES,
            'totalNovels' => Novel::count(),
        ]);
    }

    public function create()
    {
        return view('novels.create', [
            'novel' => new Novel,
            'origins' => Novel::ORIGINS,
            'statuses' => Novel::STATUSES,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        $novel = Novel::create($validated);

        // A redirect, not a view, so pressing F5 can't add the novel twice.
        return redirect()
            ->route('novels.index')
            ->with('success', "Added \"{$novel->title}\".");
    }

    public function edit(Novel $novel)
    {
        return view('novels.edit', [
            'novel' => $novel,
            'origins' => Novel::ORIGINS,
            'statuses' => Novel::STATUSES,
        ]);
    }

    public function update(Request $request, Novel $novel)
    {
        $validated = $request->validate($this->rules());

        $novel->update($validated);

        return redirect()
            ->route('novels.index')
            ->with('success', "Updated \"{$novel->title}\".");
    }

    public function destroy(Novel $novel)
    {
        $novel->delete();

        return redirect()
            ->route('novels.index')
            ->with('success', "Deleted \"{$novel->title}\".");
    }

    /**
     * The validation rules shared by store and update.
     */
    private function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:150'],
            'author' => ['required', 'string', 'max:100'],
            'origin' => ['required', Rule::in(Novel::ORIGINS)],
            'status' => ['required', Rule::in(Novel::STATUSES)],
            'total_chapters' => ['required', 'integer', 'min:1'],
            'chapters_read' => ['required', 'integer', 'min:0', 'lte:total_chapters'],
            'rating' => ['required', 'numeric', 'between:0,10'],
            'is_favourite' => ['boolean'],
        ];
    }
}
