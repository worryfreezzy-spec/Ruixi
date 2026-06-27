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
            'category' => ['nullable', 'string', 'max:255'],
            'treatment' => ['nullable', 'string', 'max:255'],
            'referral' => ['nullable', 'string', 'max:255'],
            'branch' => ['nullable', 'string', 'max:255'],
            'comments' => ['nullable', 'string', 'max:2000'],
            'form_key' => ['nullable', 'string', 'max:100'],
        ]);

        $formKey = $validated['form_key'] ?? 'treatment_registration';
        $treatment = $validated['treatment'] ?? null;

        if ($formKey === 'treatment_registration' && blank($treatment)) {
            $treatment = $validated['category'] ?? $validated['page'] ?? null;
        }

        $treatment = $this->localizeTreatment($treatment);
        $referral = $this->localizeReferral($validated['referral'] ?? null);

        $form = ContactForm::query()
            ->where('key', $formKey)
            ->where('is_active', true)
            ->first();

        ContactSubmission::query()->create([
            'form_id' => $form?->id,
            'form_key' => $formKey,
            'page' => $validated['page'] ?? null,
            'treatment' => $treatment,
            'branch' => $validated['branch'] ?? null,
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'referral' => $referral,
            'comments' => $validated['comments'] ?? null,
            'data' => array_merge($validated, [
                'treatment' => $treatment,
                'referral' => $referral,
            ]),
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

    private function localizeTreatment(?string $treatment): ?string
    {
        if (! $treatment) {
            return $treatment;
        }

        return [
            'ZEISS SMILE Pro 2' => '蔡司 SMILE Pro 2.0',
            'Presbyond 2' => 'Presbyond 2.0 老花矫正',
            'ZEISS SMILE' => '蔡司 SMILE (ReLEx SMILE)',
            'Femto-LASIK' => '个性化飞秒 LASIK',
            'Cataract' => '白内障',
            'Glaucoma' => '青光眼',
            'Diabetic Eye Disease' => '糖尿病眼病',
            'Conjunctivitis' => '结膜炎',
            'Dry Eyes' => '干眼症',
            'Pterygium' => '翼状胬肉',
            'Age Related Macular Degeneration' => '老年性黄斑变性',
            'Retinal Detachment' => '视网膜脱落',
            'Cornea Disease' => '角膜疾病',
            'Lid Disorder' => '眼睑疾病',
            'Myopia (Kids)' => '儿童近视控制',
            'Amblyopia (Kids)' => '弱视 (懒惰眼)',
            'Squints (Kids)' => '儿童斜视',
            'Eye Examination (Kids)' => '儿童眼睛检查',
            'Ortho-K' => '角膜塑形镜 (夜戴镜)',
            'Eye Examination' => '眼睛检查',
            'Corporate Eye Screening' => '企业眼科筛查',
            'Plastic Surgery' => '整形手术',
            'Others' => '其他',
        ][$treatment] ?? $treatment;
    }

    private function localizeReferral(?string $referral): ?string
    {
        if (! $referral) {
            return $referral;
        }

        return [
            'Friend/Relatives' => '朋友/亲戚',
            'Newspaper/Magazine' => '报纸/杂志',
            'Billboards/Posters' => '广告牌/海报',
            'Event/Roadshow' => '活动/路演',
            'SMS/Email' => '短信/电子邮件',
            'Website' => '网站',
            'Facebook' => '脸书',
            'Others' => '其他',
            'Quick Form' => '快速表单',
        ][$referral] ?? $referral;
    }
}
