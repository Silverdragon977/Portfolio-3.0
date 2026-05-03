
@extends('layouts.defaultLayout')
@section('pageName', 'Contact Me')
    @section('header')
    @endsection
    @section('pageScripts')
    <script>
        function copyEmail() {
            const email = document.getElementById("contact-email").value;
            navigator.clipboard.writeText(email);

            const btn = document.querySelector(".uiverse__contact-copy-btn");
            btn.textContent = "Copied!";

            setTimeout(() => {
                btn.textContent = "Copy";
            }, 1500);
        }
    </script>
    @endsection
    @section('mainContent')
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

<div class="uiverse__contact-wrapper">

    {{-- ============================= --}}
    {{-- ABOUT / DIRECT CONTACT AREA  --}}
    {{-- ============================= --}}

    <section class="uiverse__contact-intro">

        <h2 class="uiverse__contact-title">
            Let’s Build Something Great
        </h2>

        <p class="uiverse__contact-description">
            I'm a full-stack developer passionate about building secure,
            scalable web applications with Laravel and modern frontend tools.
            If you're looking for someone to bring ideas to life —
            I’d love to connect.
        </p>

        <div class="uiverse__contact-social-buttons">
        
            <a href="https://linkedin.com/"
                 target="_blank"
                 class="uiverse__contact-linkedin-button">
            
                  <div class="uiverse__contact-linkedin-dots"></div>
            
                  <span class="uiverse__contact-linkedin-text">
                    My LinkedIn Profile
                  </span>
            </a>
            <a href="https://github.com/"
                 target="_blank"
                 class="uiverse__contact-linkedin-button uiverse__social-button-reverse-animation">
            
                  <div class="uiverse__contact-linkedin-dots"></div>
            
                  <span class="uiverse__contact-linkedin-text">
                    My Github Profile
                  </span>
          </a>
      
        </div>
        

        {{-- Email Copy Block --}}
        <div class="uiverse__contact-email-block">
        
            <input type="text"
                   id="contact-email"
                   value="michaelhoward977@email.com"
                   readonly
                   class="uiverse__contact-email-input">
        
            <button type="button"
                    class="uiverse__contact-email-button"
                    onclick="copyEmail()">
        
                <span class="uiverse__contact-email-tooltip"
                      data-text-initial="Copy email"
                      data-text-end="Copied!">
                </span>
            
                <svg viewBox="0 0 24 24"
                     width="20"
                     height="20"
                     fill="currentColor">
                    <path d="M16 1H4a2 2 0 0 0-2 2v12h2V3h12V1z"/>
                    <path d="M19 5H8a2 2 0 0 0-2 2v14h13a2 2 0 0 0 2-2V5zm0 16H8V7h11v14z"/>
                </svg>
            
            </button>
        
        </div>

    </section>


    {{-- ============================= --}}
    {{-- FORM SECTION --}}
    {{-- ============================= --}}

    <section class="uiverse__contact-form-section">

        @if(session('success'))
            <div class="uiverse__contact-success">
                {{ session('success') }}
            </div>
        @endif

<div class="uiverse__contact-message-container">

    <div class="uiverse__contact-message-card1">
        <div class="uiverse__contact-message-card2">

            <form method="POST"
                  action="{{ route('contact.store') }}"
                  class="uiverse__contact-message-form">

                @csrf

                <p class="uiverse__contact-message-heading">
                    Send Me a Message
                </p>

                <div class="uiverse__contact-message-field">
                    <input type="text"
                           name="fullName"
                           required
                           placeholder="Full Name"
                           class="uiverse__contact-message-input @error('fullName') uiverse__login-form-field--error @enderror"
                           novalidate>
                           @error('fullName')
                                <div class="uiverse__login-form-error">{{ $message }}</div>
                            @enderror
                </div>

                <div class="uiverse__contact-message-field">
                    <input type="email"
                           name="email"
                           required
                           placeholder="Email"
                           class="uiverse__contact-message-input @error('email') uiverse__login-form-field--error @enderror">
                           @error('email')
                                <div class="uiverse__login-form-error">{{ $message }}</div>
                            @enderror
                </div>

                <div class="uiverse__contact-message-field">
                    <textarea name="comment"
                              required
                              rows="7"
                              placeholder="Message"
                              class="uiverse__contact-message-input @error('comment') uiverse__login-form-field--error @enderror"></textarea>
                              @error('comment')
                                  <div class="uiverse__login-form-error">{{ $message }}</div>
                              @enderror
                </div>

                <button type="submit"
                        class="uiverse__contact-message-button">
                    Send Message
                </button>

            </form>

        </div>
    </div>

</div>

    </section>

</div>

    @endsection
