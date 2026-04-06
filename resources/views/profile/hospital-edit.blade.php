@extends('layouts.app')

@section('title', 'Edit Hospital Profile')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap');

    .profile-page * { box-sizing: border-box; }

    .profile-page {
        --red: #C8102E;
        --red-dark: #9B0B22;
        --red-soft: #FFF0F2;
        --red-mid: #FFD6DC;
        --ink: #1A1014;
        --ink-mid: #5A424A;
        --ink-light: #9C8A90;
        --surface: #FDFBFB;
        --surface-2: #F7F2F3;
        --border: #EDE4E6;
        --white: #FFFFFF;
        --success: #0D7A5F;
        --success-bg: #EDFAF5;
        font-family: 'DM Sans', sans-serif;
        background: var(--surface);
        min-height: 100vh;
        padding: 48px 24px 80px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }

    .profile-wrapper {
        width: 100%;
        max-width: 860px;
    }

    /* ── Back link ── */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 500;
        color: var(--ink-light);
        text-decoration: none;
        margin-bottom: 32px;
        letter-spacing: .03em;
        transition: color .2s;
    }
    .back-link:hover { color: var(--red); }
    .back-link svg { transition: transform .2s; }
    .back-link:hover svg { transform: translateX(-3px); }

    /* ── Card ── */
    .profile-card {
        background: var(--white);
        border-radius: 24px;
        border: 1px solid var(--border);
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(26,16,20,.04), 0 12px 40px rgba(26,16,20,.07);
    }

    /* ── Header banner ── */
    .profile-banner {
        background: linear-gradient(135deg, #2D3748 0%, #1A202C 100%);
        padding: 40px 48px 64px;
        position: relative;
        overflow: hidden;
    }
    .profile-banner::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Ccircle cx='30' cy='30' r='28' stroke='rgba(255,255,255,.06)' stroke-width='1'/%3E%3C/g%3E%3C/svg%3E") repeat;
        opacity: .4;
    }
    .profile-banner::after {
        content: '🏥';
        position: absolute;
        right: 40px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 96px;
        opacity: .08;
        filter: grayscale(1) invert(1);
    }

    .banner-title {
        font-family: 'DM Serif Display', serif;
        font-size: 32px;
        color: var(--white);
        margin: 0 0 6px;
        position: relative;
        z-index: 1;
    }
    .banner-sub {
        font-size: 14px;
        color: rgba(255,255,255,.7);
        position: relative;
        z-index: 1;
        font-weight: 400;
        letter-spacing: .02em;
    }

    /* ── Avatar strip ── */
    .avatar-strip {
        background: var(--white);
        padding: 0 48px;
        display: flex;
        align-items: flex-end;
        gap: 20px;
        margin-top: -32px;
        position: relative;
        z-index: 2;
        padding-bottom: 0;
    }
    .avatar-bubble {
        width: 72px;
        height: 72px;
        background: var(--white);
        border-radius: 18px;
        border: 3px solid var(--white);
        box-shadow: 0 4px 20px rgba(0,0,0,.15);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 34px;
        flex-shrink: 0;
        margin-bottom: 12px;
    }
    .avatar-name {
        padding-bottom: 14px;
    }
    .avatar-name h2 {
        font-family: 'DM Serif Display', serif;
        font-size: 22px;
        color: var(--ink);
        margin: 0 0 2px;
    }
    .avatar-name p {
        font-size: 13px;
        color: var(--ink-light);
        margin: 0;
        font-weight: 400;
    }

    /* ── Divider ── */
    .strip-divider {
        height: 1px;
        background: var(--border);
        margin: 0 48px;
    }

    /* ── Body ── */
    .profile-body {
        padding: 36px 48px 48px;
    }

    /* Alerts */
    .alert-success {
        display: flex;
        align-items: center;
        gap: 12px;
        background: var(--success-bg);
        border: 1px solid #A8E8D4;
        border-radius: 14px;
        padding: 14px 18px;
        margin-bottom: 32px;
        font-size: 14px;
        font-weight: 500;
        color: var(--success);
    }
    
    .section-label {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: #4A5568;
        margin: 0 0 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .section-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--border);
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-bottom: 36px;
    }

    @media (max-width: 640px) {
        .form-grid { grid-template-columns: 1fr; }
        .profile-banner { padding: 32px 24px 56px; }
        .avatar-strip { padding: 0 24px; }
        .strip-divider { margin: 0 24px; }
        .profile-body { padding: 28px 24px 40px; }
    }

    .form-col { display: flex; flex-direction: column; gap: 20px; }

    .field { display: flex; flex-direction: column; gap: 7px; }
    .field label {
        font-size: 12px;
        font-weight: 600;
        color: var(--ink-mid);
        letter-spacing: .04em;
        text-transform: uppercase;
    }
    .field input {
        width: 100%;
        padding: 13px 16px;
        border-radius: 12px;
        border: 1.5px solid var(--border);
        background: var(--surface-2);
        font-family: 'DM Sans', sans-serif;
        font-size: 15px;
        color: var(--ink);
        outline: none;
        transition: border-color .2s, background .2s, box-shadow .2s;
    }
    .field input[readonly] {
        background: #F3F4F6;
        color: #6B7280;
        cursor: not-allowed;
        border-color: #E5E7EB;
    }
    .field input:not([readonly]):focus {
        border-color: #4A5568;
        background: var(--white);
        box-shadow: 0 0 0 4px rgba(74,85,104,.1);
    }
    .field-error { font-size: 12px; color: var(--red); font-weight: 500; }

    /* Note */
    .info-note {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 14px 16px;
        background: var(--surface-2);
        border: 1px solid var(--border);
        border-radius: 12px;
        font-size: 13px;
        color: var(--ink-light);
        line-height: 1.5;
    }

    /* Footer */
    .form-footer {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 16px;
        padding-top: 28px;
        border-top: 1px solid var(--border);
    }

    .btn-ghost {
        padding: 13px 24px;
        border-radius: 12px;
        border: 1.5px solid var(--border);
        background: transparent;
        font-size: 14px;
        font-weight: 500;
        color: var(--ink-mid);
        text-decoration: none;
    }

    .btn-save {
        padding: 13px 36px;
        border-radius: 12px;
        border: none;
        background: #1A202C;
        font-size: 14px;
        font-weight: 600;
        color: var(--white);
        cursor: pointer;
        box-shadow: 0 4px 18px rgba(0,0,0,.2);
        transition: transform .15s;
    }
    .btn-save:hover { transform: translateY(-1px); }
</style>

<div class="profile-page">
    <div class="profile-wrapper">
        <a href="{{ url()->previous() }}" class="back-link">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Back
        </a>

        <div class="profile-card">
            {{-- Banner --}}
            <div class="profile-banner">
                <p class="banner-title">{{ $user->hospitalProfile->hospital_name ?? 'Hospital Account' }}</p>
                <p class="banner-sub">Joined {{ $user->created_at->format('M Y') }} &nbsp;·&nbsp;
                    @if($user->hospitalProfile && $user->hospitalProfile->is_verified)
                        <span style="color:#A8E8D4; font-weight:bold;">Verified Facility</span>
                    @else
                        <span style="color:#FFE082; font-weight:bold;">Pending Verification</span>
                    @endif
                </p>
            </div>

            {{-- Avatar strip --}}
            <div class="avatar-strip">
                <div class="avatar-bubble">🏥</div>
                <div class="avatar-name">
                    <h2>{{ $user->hospitalProfile->hospital_name ?? 'Hospital' }}</h2>
                    <p>{{ $user->email }}</p>
                </div>
            </div>

            <div class="strip-divider"></div>

            {{-- Body --}}
            <div class="profile-body">
                @if(session('success'))
                    <div class="alert-success">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">
                        {{-- Left: Immutable Info --}}
                        <div class="form-col">
                            <p class="section-label">Facility Details</p>

                            <div class="field">
                                <label for="hospital_name">Registered Name</label>
                                <input type="text" id="hospital_name" value="{{ $user->hospitalProfile->hospital_name ?? '' }}" readonly title="Cannot edit registered name">
                            </div>

                            <div class="field">
                                <label for="license_number">License Number</label>
                                <input type="text" id="license_number" value="{{ $user->hospitalProfile->license_number ?? '' }}" readonly title="Cannot edit license number">
                            </div>

                            <div class="info-note">
                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 8v4m0 4h.01"/></svg>
                                For security reasons, Facility Name and License Number cannot be changed. Contact admin for modifications.
                            </div>
                        </div>

                        {{-- Right: Contact --}}
                        <div class="form-col">
                            <p class="section-label">Contact Information</p>

                            <div class="field">
                                <label for="contact_phone">Contact Phone</label>
                                <input type="text" id="contact_phone" name="contact_phone"
                                       value="{{ old('contact_phone', $user->hospitalProfile->contact_phone ?? '') }}" required>
                                @error('contact_phone') <p class="field-error">{{ $message }}</p> @enderror
                            </div>

                            <div class="field">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city"
                                       value="{{ old('city', $user->hospitalProfile->city ?? '') }}" required>
                                @error('city') <p class="field-error">{{ $message }}</p> @enderror
                            </div>

                            <div class="field">
                                <label for="address">Full Address</label>
                                <input type="text" id="address" name="address"
                                       value="{{ old('address', $user->hospitalProfile->address ?? '') }}" required>
                                @error('address') <p class="field-error">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-footer">
                        <a href="{{ url()->previous() }}" class="btn-ghost">Cancel</a>
                        <button type="submit" class="btn-save">Save Setup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
