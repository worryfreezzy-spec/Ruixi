@props([
    'cta' => null,
    'variant' => 'simple',
    'defaultTreatment' => null,
])

@php
    $active = $cta?->is_active ?? false;
    $isForm = $cta?->show_form || $variant === 'form';
    $style = $cta?->background_image_url ? "background-image: url('{$cta->background_image_url}')" : null;
    $fallbackTreatment = $defaultTreatment ?: trim($__env->yieldContent('title'));
    $buttonUrl = $cta?->button_url
        ? (preg_match('/^https?:\/\//', $cta->button_url) ? $cta->button_url : url($cta->button_url))
        : null;
@endphp

@if ($active)
    <div class="row {{ $isForm ? 'cta2021' : 'cta2' }}" @if($style) style="{{ $style }}" @endif>
        <div class="{{ $isForm ? 'col-md x15-md' : 'col half-left' }} pad fade-up">
            @if ($cta->subtitle)
                <h4>{{ $cta->subtitle }}</h4>
            @endif

            @if ($cta->title)
                <h1>{!! str_replace('今天', '<strong>今天</strong>', e($cta->title)) !!}</h1>
            @endif

            @if ($cta->description)
                <p>{!! nl2br(e($cta->description)) !!}</p>
            @endif

            @if ($cta->extra_text)
                <p>{!! nl2br(e($cta->extra_text)) !!}</p>
            @endif

            @if ($cta->note)
                <h6>{{ $cta->note }}</h6>
            @endif

            @if (! $isForm && $cta->button_text && $buttonUrl)
                <a class="button2 button-cta" href="{{ $buttonUrl }}">{{ $cta->button_text }}</a>
            @endif
        </div>

        @if ($isForm)
            <div class="col-md x15-md pad fade-up">
                <h3 class="t-blue"><strong>注册表格</strong></h3>
                @if (session('contact_success'))
                    <p class="t-blue"><strong>{{ session('contact_success') }}</strong></p>
                @endif
                <form action="{{ route('contact.submit') }}" id="myForm" method="post" data-contact-form>
                    @csrf
                    <input class="honey" name="honey" type="text">
                    <label for="name">名字: *</label><br>
                    <input name="name" type="text" id="name" placeholder="您的名字" value="{{ old('name') }}" required>
                    <br>
                    <label for="phone">电话号码: *</label><br>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required>
                    <br>
                    <label for="email">电邮: *</label><br>
                    <input type="text" name="email" id="email" placeholder="您的电邮" value="{{ old('email') }}" required>
                    <input name="form_key" id="form_key" type="hidden" value="{{ $cta->key ?? 'treatment_registration' }}">
                    <input name="page" id="page" type="hidden" value="{{ trim($__env->yieldContent('title')) }}">
                    <input name="category" id="category" type="hidden" value="{{ $fallbackTreatment }}">
                    <input name="treatment" id="treatment" type="hidden" value="{{ $fallbackTreatment }}">
                    <input name="referral" id="referral" value="快速表格" type="hidden">
                    <input name="comments" id="comments" value="N/A" type="hidden">
                    <br>
                    <input name="submit" type="submit" value="提交">
                </form>
                <p class="contact-form-error" id="contactFormError" hidden></p>
                <p><small>* 需填写所有栏目</small></p>
            </div>
            <div class="col-md"></div>
        @endif
    </div>

    @if ($isForm)
        <div class="contact-success-modal" id="contactSuccessModal" aria-hidden="true">
            <div class="contact-success-dialog" role="dialog" aria-modal="true" aria-labelledby="contactSuccessTitle">
                <button class="contact-success-close" type="button" aria-label="关闭">&times;</button>
                <div class="contact-success-icon">✓</div>
                <h3 id="contactSuccessTitle">提交成功</h3>
                <p>感谢您的注册，我们已经收到您的信息，会尽快与您联系。</p>
                <button class="contact-success-button" type="button">好的</button>
            </div>
        </div>

        @once
            @push('styles')
                <style>
                    .contact-form-error {
                        margin-top: 12px;
                        color: #b3261e;
                        font-weight: 700;
                    }

                    .contact-success-modal {
                        align-items: center;
                        background: rgba(12, 22, 56, 0.62);
                        bottom: 0;
                        display: none;
                        justify-content: center;
                        left: 0;
                        padding: 24px;
                        position: fixed;
                        right: 0;
                        top: 0;
                        z-index: 9999;
                    }

                    .contact-success-modal.is-open {
                        display: flex;
                    }

                    .contact-success-dialog {
                        background: #fff;
                        border-radius: 8px;
                        box-shadow: 0 24px 80px rgba(12, 22, 56, 0.28);
                        max-width: 420px;
                        padding: 36px 34px 32px;
                        position: relative;
                        text-align: center;
                        width: 100%;
                    }

                    .contact-success-close {
                        background: transparent;
                        border: 0;
                        color: #748094;
                        cursor: pointer;
                        font-size: 30px;
                        line-height: 1;
                        position: absolute;
                        right: 16px;
                        top: 12px;
                    }

                    .contact-success-icon {
                        align-items: center;
                        background: #00a9a5;
                        border-radius: 50%;
                        color: #fff;
                        display: inline-flex;
                        font-size: 34px;
                        font-weight: 700;
                        height: 72px;
                        justify-content: center;
                        margin-bottom: 18px;
                        width: 72px;
                    }

                    .contact-success-dialog h3 {
                        color: #0c1638;
                        margin: 0 0 10px;
                    }

                    .contact-success-dialog p {
                        color: #42506a;
                        margin-bottom: 24px;
                    }

                    .contact-success-button {
                        background: #0c79be;
                        border: 0;
                        border-radius: 4px;
                        color: #fff;
                        cursor: pointer;
                        font-weight: 700;
                        padding: 12px 34px;
                    }
                </style>
            @endpush

            @push('scripts')
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        document.querySelectorAll('form[data-contact-form]').forEach(function (form) {
                            const modal = document.getElementById('contactSuccessModal');
                            const error = form.parentElement.querySelector('.contact-form-error');
                            const submit = form.querySelector('[type="submit"]');

                            const closeModal = function () {
                                if (modal) {
                                    modal.classList.remove('is-open');
                                    modal.setAttribute('aria-hidden', 'true');
                                }
                            };

                            if (modal) {
                                modal.querySelectorAll('.contact-success-close, .contact-success-button').forEach(function (button) {
                                    button.addEventListener('click', closeModal);
                                });

                                modal.addEventListener('click', function (event) {
                                    if (event.target === modal) {
                                        closeModal();
                                    }
                                });
                            }

                            form.addEventListener('submit', async function (event) {
                                event.preventDefault();

                                const token = form.querySelector('input[name="_token"]')?.value || '';

                                if (error) {
                                    error.hidden = true;
                                    error.textContent = '';
                                }

                                if (submit) {
                                    submit.disabled = true;
                                    submit.value = '提交中...';
                                }

                                try {
                                    const response = await fetch(form.action, {
                                        method: 'POST',
                                        body: new FormData(form),
                                        credentials: 'same-origin',
                                        headers: {
                                            'Accept': 'application/json',
                                            'X-Requested-With': 'XMLHttpRequest',
                                            'X-CSRF-TOKEN': token,
                                        },
                                    });

                                    if (! response.ok) {
                                        let message = '提交失败，请检查信息后再试。';

                                        try {
                                            const data = await response.json();
                                            message = data.message || Object.values(data.errors || {})[0]?.[0] || message;
                                        } catch (parseError) {
                                            //
                                        }

                                        throw new Error(message);
                                    }

                                    form.reset();

                                    if (modal) {
                                        modal.classList.add('is-open');
                                        modal.setAttribute('aria-hidden', 'false');
                                    }
                                } catch (exception) {
                                    if (error) {
                                        error.textContent = exception.message || '提交失败，请检查信息后再试。';
                                        error.hidden = false;
                                    }
                                } finally {
                                    if (submit) {
                                        submit.disabled = false;
                                        submit.value = '提交';
                                    }
                                }
                            });
                        });
                    });
                </script>
            @endpush
        @endonce
    @endif
@endif
