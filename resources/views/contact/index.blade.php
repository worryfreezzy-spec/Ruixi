@extends('frontend.layout')

@section('body_id', 'contact')
@section('title', $page->title)
@section('description', $page->summary)

@section('content')
    <div class="banner zoom">
        <div class="hero hero39 nofade"></div>
        @if ($page->hero_title)<h1 class="tagline">{{ $page->hero_title }}</h1>@endif
    </div>

    <div class="centered pad">
        <h1>{!! $page->title !!}</h1>
        @if ($page->summary)<p>{!! nl2br(e($page->summary)) !!}</p>@endif
    </div>

    <div class="row fade-up">
        <div class="col blue">
            <div class="pad">
                @include('contact.partials.branch-list')
            </div>
        </div>
        <div id="eform" class="col mint">
            <div class="pad">
                @if ($formSection?->title)<h2>{!! $formSection->title !!}</h2>@endif
                @if ($formSection?->description)<p>{!! nl2br(e($formSection->description)) !!}</p>@endif
                @if ($formSection?->subtitle)<h6>{{ $formSection->subtitle }}</h6>@endif

                @if (session('contact_success'))
                    <p class="t-blue"><strong>{{ session('contact_success') }}</strong></p>
                @endif

                <form action="{{ route('contact.submit') }}" id="myForm" method="post">
                    @csrf
                    <input class="honey" name="honey" type="text">
                    <label for="name">名字: *</label><br>
                    <input name="name" type="text" id="name" placeholder="您的名字" value="{{ old('name') }}" required><br>
                    <label for="phone">电话号码: *</label><br>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required><br>
                    <label for="email">电邮: *</label><br>
                    <input type="text" name="email" id="email" placeholder="您的电邮" value="{{ old('email') }}" required><br>
                    <label for="treatment">感兴趣的治疗项目*</label><br>
                    <textarea name="treatment" id="treatment" rows="3" style="width: 70%; min-height: 9rem;" required>{{ old('treatment') }}</textarea><br>
                    <label for="referral">您如何知道OPTIMAX? *</label><br>
                    <select id="referral" name="referral" required>
                        <option value="" selected>选择一个来源...</option>
                        <option value="朋友/亲戚">朋友/亲戚</option>
                        <option value="报纸/杂志">报纸/杂志</option>
                        <option value="广告牌/海报">广告牌/海报</option>
                        <option value="活动/路演">活动/路演</option>
                        <option value="短信/电子邮件">短信/电子邮件</option>
                        <option value="网站">网站</option>
                        <option value="脸书">脸书</option>
                        <option value="其他">其他</option>
                    </select><br>
                    <label for="comments">查询: *</label><br>
                    <textarea name="comments" rows="8" cols="40" id="comments" required>{{ old('comments') }}</textarea>
                    <input name="form_key" type="hidden" value="contact_page">
                    <input name="page" type="hidden" value="联系我们">
                    <br>
                    <input name="submit" type="submit" value="提交">
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .form-feedback {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            background: rgba(12, 22, 56, .48);
        }

        .form-feedback.is-active {
            display: flex;
        }

        .form-feedback__box {
            width: min(92vw, 420px);
            padding: 2rem;
            border-radius: 8px;
            background: #fff;
            text-align: center;
            box-shadow: 0 22px 60px rgba(0, 0, 0, .22);
        }

        .form-feedback__icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 54px;
            height: 54px;
            margin-bottom: 1rem;
            border-radius: 50%;
            background: #12a66a;
            color: #fff;
            font-size: 2rem;
            line-height: 1;
        }

        .form-feedback.is-error .form-feedback__icon {
            background: #c43c35;
        }

        .form-feedback__title {
            margin: 0 0 .5rem;
            color: #21182D;
            font-size: 1.4rem;
            font-weight: 600;
        }

        .form-feedback__message {
            margin: 0 0 1.25rem;
            color: #333;
            line-height: 1.6;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('static/js/intlTelInput.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('#myForm');
            const phoneInput = document.querySelector('#phone');

            if (phoneInput && window.intlTelInput) {
                const iti = window.intlTelInput(phoneInput, {
                    initialCountry: 'my',
                    separateDialCode: true,
                });

                phoneInput.form?.addEventListener('submit', function () {
                    const country = iti.getSelectedCountryData();
                    const rawValue = phoneInput.value.trim();
                    if (rawValue && !rawValue.startsWith('+') && country?.dialCode) {
                        phoneInput.value = '+' + country.dialCode + rawValue.replace(/^0+/, '');
                    }
                });
            }

            if (!form) {
                return;
            }

            const feedback = document.createElement('div');
            feedback.className = 'form-feedback';
            feedback.innerHTML = `
                <div class="form-feedback__box" role="dialog" aria-modal="true" aria-live="polite">
                    <div class="form-feedback__icon">✓</div>
                    <h3 class="form-feedback__title">提交成功</h3>
                    <p class="form-feedback__message">感谢您的查询，我们会尽快与您联系。</p>
                    <button class="button2" type="button">确定</button>
                </div>
            `;
            document.body.appendChild(feedback);

            const icon = feedback.querySelector('.form-feedback__icon');
            const title = feedback.querySelector('.form-feedback__title');
            const message = feedback.querySelector('.form-feedback__message');
            const closeButton = feedback.querySelector('button');
            const submitButton = form.querySelector('[type="submit"]');
            const submitText = submitButton?.value;

            const showFeedback = function (type, text) {
                const isError = type === 'error';
                feedback.classList.toggle('is-error', isError);
                icon.textContent = isError ? '!' : '✓';
                title.textContent = isError ? '提交失败' : '提交成功';
                message.textContent = text;
                feedback.classList.add('is-active');
            };

            const hideFeedback = function () {
                feedback.classList.remove('is-active');
            };

            closeButton.addEventListener('click', hideFeedback);
            feedback.addEventListener('click', function (event) {
                if (event.target === feedback) {
                    hideFeedback();
                }
            });

            form.addEventListener('submit', async function (event) {
                event.preventDefault();

                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                if (submitButton) {
                    submitButton.disabled = true;
                    submitButton.value = '提交中...';
                }

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
                        headers: {
                            Accept: 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    });
                    const data = await response.json().catch(() => ({}));

                    if (!response.ok) {
                        const errors = data.errors ? Object.values(data.errors).flat() : [];
                        throw new Error(errors[0] || data.message || '提交失败，请检查信息后再试。');
                    }

                    form.reset();
                    showFeedback('success', data.message || '感谢您的查询，我们会尽快与您联系。');
                } catch (error) {
                    showFeedback('error', error.message || '提交失败，请检查信息后再试。');
                } finally {
                    if (submitButton) {
                        submitButton.disabled = false;
                        submitButton.value = submitText || '提交';
                    }
                }
            });
        });
    </script>
@endpush
