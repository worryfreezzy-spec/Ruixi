<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchCity;
use App\Models\Page;
use Illuminate\Contracts\View\View;

class ContactPageController
{
    public function index(): View
    {
        $page = Page::query()
            ->where('slug', 'contact')
            ->where('is_active', true)
            ->with('sections')
            ->firstOrFail();

        return view('contact.index', [
            'page' => $page,
            'branchSection' => $page->sections->firstWhere('type', 'contact_branches'),
            'formSection' => $page->sections->firstWhere('type', 'contact_form'),
            'cities' => $this->cities(),
            'branches' => Branch::query()->where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function show(string $slug): View
    {
        $branch = Branch::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->with('city')
            ->firstOrFail();

        $page = Page::query()
            ->where('slug', 'contact')
            ->where('is_active', true)
            ->with('sections')
            ->firstOrFail();

        return view('contact.branch', [
            'page' => $page,
            'branch' => $branch,
            'branchSection' => $page->sections->firstWhere('type', 'contact_branches'),
            'cities' => $this->cities(),
        ]);
    }

    private function cities()
    {
        return BranchCity::query()
            ->where('is_active', true)
            ->with(['branches' => fn ($query) => $query->where('is_active', true)->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->get();
    }
}
