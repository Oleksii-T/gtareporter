@extends('layouts.app')

@section('title', $page?->meta_title ?: 'Contact Us')
@section('description', $page?->meta_description)

@section('content')
<div class="page">

    <div class="cat-header">
        <h1 class="cat-title">Contact Us</h1>
    </div>

    <div class="contact-layout">

        <div class="contact-form-wrap">
            <form class="contact-form" id="contact-form" action="{{ route('feedbacks.store') }}" method="post">
                @csrf
                <div class="contact-form__field">
                    <label class="contact-form__label" for="contact-name">Name</label>
                    <input class="contact-form__input" type="text" id="contact-name" name="name" placeholder="Your name" required>
                </div>
                <div class="contact-form__field">
                    <label class="contact-form__label" for="contact-email">Email</label>
                    <input class="contact-form__input" type="email" id="contact-email" name="email" placeholder="name@example.com" required>
                </div>
                <div class="contact-form__field">
                    <label class="contact-form__label" for="contact-subject">Subject</label>
                    <input class="contact-form__input" type="text" id="contact-subject" name="subject" placeholder="What is this about?" required>
                </div>
                <div class="contact-form__field">
                    <label class="contact-form__label" for="contact-text">Message</label>
                    <textarea class="contact-form__textarea" id="contact-text" name="text" rows="6" placeholder="Share the details." required></textarea>
                </div>
                <button class="contact-form__btn" type="submit">{{ $page->show('form:cta', 'Send message') }}</button>
                <p class="form-status" id="contact-status" role="status" aria-live="polite"></p>
            </form>
        </div>

        <div class="contact-side-blocks">
            <div class="contact-block">
                @if ($page->show('side:content') && $page->show('side:content') !== 'todo')
                    {!! $page->show('side:content') !!}
                @else
                    <span class="eyebrow">LET'S TALK VICE CITY</span>
                    <h2>Got a story?<br>We're listening.</h2>
                    <p>Send a news tip, suggest a correction, or get in touch with the publication.</p>
                    <p>For official game support, visit <a href="https://support.rockstargames.com/">Rockstar Support</a>.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="contact-blocks-grid">
        <x-content-blocks :blocks="$blocks" type="1" />
    </div>
</div>
@endsection

@section('scripts')
@if (config('services.recaptcha.public_key'))
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.public_key') }}"></script>
@endif
<script>
(() => {
    const form = document.getElementById('contact-form');
    const button = form.querySelector('button[type="submit"]');
    const status = document.getElementById('contact-status');
    const originalLabel = button.textContent;
    const recaptchaKey = @json(config('services.recaptcha.public_key'));
    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        if (button.disabled) return;
        button.disabled = true;
        button.textContent = 'Sending…';
        status.textContent = '';
        try {
            const data = new FormData(form);
            if (recaptchaKey) {
                if (!window.grecaptcha) throw new Error('Verification could not load. Please refresh and try again.');
                await new Promise(resolve => grecaptcha.ready(resolve));
                data.append('g-recaptcha-response', await grecaptcha.execute(recaptchaKey, { action: 'contact' }));
            }
            const response = await fetch(form.action, {
                method: 'POST', body: data,
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            });
            const result = await response.json();
            if (!response.ok || !result.success) {
                const validationMessage = Object.values(result.errors || {}).flat()[0];
                throw new Error(validationMessage || result.message || 'Please try again.');
            }
            status.textContent = 'Message sent. Thanks for getting in touch.';
            form.reset();
        } catch (error) {
            status.textContent = error.message || 'The message could not be sent. Please try again.';
        } finally {
            button.disabled = false;
            button.textContent = originalLabel;
        }
    });
})();
</script>
@endsection
