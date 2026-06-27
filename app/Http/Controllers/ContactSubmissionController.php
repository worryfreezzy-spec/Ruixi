<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use App\Models\ContactSubmission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactSubmissionController
{
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        if (filled($request->input('honey'))) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => '提交成功，我们会尽快与您联系。',
                ]);
            }

            return back()->with('contact_success', '提交成功，我们会尽快与您联系。');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'max:255'],
            'page' => ['nullable', 'string', 'max:255'],
            'treatment' => ['nullable', 'string', 'max:255'],
            'referral' => ['nullable', 'string', 'max:255'],
            'comments' => ['nullable', 'string', 'max:2000'],
            'form_key' => ['nullable', 'string', 'max:100'],
        ]);

        $formKey = $validated['form_key'] ?? 'treatment_registration';
        $form = ContactForm::query()
            ->where('key', $formKey)
            ->where('is_active', true)
            ->first();

        ContactSubmission::query()->create([
            'form_id' => $form?->id,
            'form_key' => $formKey,
            'page' => $validated['page'] ?? null,
            'treatment' => $validated['treatment'] ?? null,
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'referral' => $validated['referral'] ?? null,
            'comments' => $validated['comments'] ?? null,
            'data' => $validated,
            'status' => 'new',
            'ip_address' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => '提交成功，我们会尽快与您联系。',
            ]);
        }

        return back()->with('contact_success', '提交成功，我们会尽快与您联系。');
    }
}
