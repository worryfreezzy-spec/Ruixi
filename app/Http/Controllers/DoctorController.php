<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Page;
use Illuminate\Contracts\View\View;

class DoctorController
{
    public function index(): View
    {
        $page = Page::query()
            ->where('slug', 'doctors')
            ->with(['sections'])
            ->firstOrFail();

        $doctors = Doctor::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('doctors.index', [
            'page' => $page,
            'sections' => $page->sections->keyBy('type'),
            'doctors' => $doctors,
        ]);
    }

    public function show(string $slug): View
    {
        $doctor = Doctor::query()
            ->whereIn('slug', [$slug, 'dr-' . $slug])
            ->where('is_active', true)
            ->firstOrFail();

        return view('doctors.show', [
            'doctor' => $doctor,
        ]);
    }
}
