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
                    <select name="treatment" id="treatment" required>
                        <option value="">请选择治疗项目</option>
                        <optgroup label="LASIK 近视矫正">
                            <option value="蔡司 SMILE Pro 2.0">蔡司 SMILE Pro 2.0</option>
                            <option value="Presbyond 2.0 老花矫正">Presbyond 2.0 老花矫正</option>
                            <option value="蔡司 SMILE (ReLEx SMILE)">蔡司 SMILE (ReLEx SMILE)</option>
                            <option value="CLEAR Max">CLEAR Max</option>
                            <option value="个性化飞秒 LASIK">个性化飞秒 LASIK</option>
                            <option value="ASA">ASA (高级表层切削术)</option>
                            <option value="TESA">TESA (经上皮表层切削术)</option>
                            <option value="ICL">ICL (植入式隐形眼镜)</option>
                            <option value="RGP">RGP (硬性透气性隐形眼镜)</option>
                        </optgroup>
                        <optgroup label="眼疾与手术">
                            <option value="白内障">白内障</option>
                            <option value="青光眼">青光眼</option>
                            <option value="糖尿病眼病">糖尿病眼病</option>
                            <option value="结膜炎">结膜炎</option>
                            <option value="干眼症">干眼症</option>
                            <option value="翼状胬肉">翼状胬肉</option>
                            <option value="老年性黄斑变性">老年性黄斑变性</option>
                            <option value="视网膜脱落">视网膜脱落</option>
                            <option value="角膜疾病">角膜疾病</option>
                            <option value="眼睑疾病">眼睑疾病</option>
                        </optgroup>
                        <optgroup label="儿童视力与眼科护理">
                            <option value="儿童近视控制">儿童近视控制</option>
                            <option value="弱视 (懒惰眼)">弱视 (懒惰眼)</option>
                            <option value="儿童斜视">儿童斜视</option>
                            <option value="儿童眼睛检查">儿童眼睛检查</option>
                            <option value="角膜塑形镜 (夜戴镜)">角膜塑形镜 (夜戴镜)</option>
                        </optgroup>
                        <option value="眼睛检查">眼睛检查</option>
                        <option value="企业眼科筛查">企业眼科筛查</option>
                        <option value="整形手术">整形手术</option>
                        <option value="其他">其他</option>
                    </select><br>
                    <label for="branch">属意分行: *</label><br>
                    <select id="branch" name="branch" required>
                        <option value="" selected>选择一个分行...</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->title }}" @selected(old('branch') === $branch->title)>{{ $branch->title }}</option>
                        @endforeach
                    </select><br>
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
