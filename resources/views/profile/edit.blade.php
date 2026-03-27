@extends('layouts.app')

@section('title', 'Edit Profile')

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
        background: linear-gradient(135deg, var(--red-dark) 0%, var(--red) 60%, #E8294A 100%);
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
        content: '🩸';
        position: absolute;
        right: 40px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 96px;
        opacity: .12;
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
        box-shadow: 0 4px 20px rgba(200,16,46,.2);
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

    /* ── Success alert ── */
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

    /* ── Section heading ── */
    .section-label {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: var(--red);
        margin: 0 0 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .section-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--red-mid);
    }

    /* ── Grid ── */
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
        .banner-title { font-size: 24px; }
    }

    .form-col { display: flex; flex-direction: column; gap: 20px; }

    /* ── Field ── */
    .field { display: flex; flex-direction: column; gap: 7px; }
    .field label {
        font-size: 12px;
        font-weight: 600;
        color: var(--ink-mid);
        letter-spacing: .04em;
        text-transform: uppercase;
    }
    .field input,
    .field select {
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
        -webkit-appearance: none;
    }
    .field input::placeholder { color: var(--ink-light); }
    .field input:focus,
    .field select:focus {
        border-color: var(--red);
        background: var(--white);
        box-shadow: 0 0 0 4px rgba(200,16,46,.08);
    }
    .field-error {
        font-size: 12px;
        color: var(--red);
        font-weight: 500;
        margin-top: 2px;
    }

    /* ── Custom select arrow ── */
    .select-wrap { position: relative; }
    .select-wrap::after {
        content: '';
        pointer-events: none;
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        width: 0; height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 6px solid var(--ink-light);
    }

    /* ── Toggle card ── */
    .toggle-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 16px 18px;
        background: var(--red-soft);
        border: 1.5px solid var(--red-mid);
        border-radius: 14px;
        cursor: pointer;
        transition: background .2s, border-color .2s;
    }
    .toggle-card:has(input:checked) {
        background: #FFF0F2;
        border-color: var(--red);
    }
    .toggle-text strong {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: var(--ink);
    }
    .toggle-text span {
        font-size: 12px;
        color: var(--ink-light);
    }
    /* Toggle switch */
    .toggle-switch { position: relative; width: 46px; height: 26px; flex-shrink: 0; }
    .toggle-switch input { opacity: 0; width: 0; height: 0; position: absolute; }
    .toggle-track {
        position: absolute; inset: 0;
        background: #DDD4D7;
        border-radius: 999px;
        transition: background .25s;
        cursor: pointer;
    }
    .toggle-track::after {
        content: '';
        position: absolute;
        top: 3px; left: 3px;
        width: 20px; height: 20px;
        background: var(--white);
        border-radius: 50%;
        box-shadow: 0 1px 4px rgba(0,0,0,.18);
        transition: transform .25s cubic-bezier(.4,0,.2,1);
    }
    .toggle-switch input:checked + .toggle-track { background: var(--red); }
    .toggle-switch input:checked + .toggle-track::after { transform: translateX(20px); }

    /* ── Info note ── */
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
    .info-note svg { flex-shrink: 0; margin-top: 1px; }

    /* ── Footer ── */
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
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        font-weight: 500;
        color: var(--ink-mid);
        cursor: pointer;
        text-decoration: none;
        transition: border-color .2s, color .2s;
    }
    .btn-ghost:hover { border-color: var(--ink-mid); color: var(--ink); }

    .btn-save {
        padding: 13px 36px;
        border-radius: 12px;
        border: none;
        background: linear-gradient(135deg, var(--red-dark), var(--red));
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: var(--white);
        cursor: pointer;
        box-shadow: 0 4px 18px rgba(200,16,46,.35);
        transition: transform .15s, box-shadow .15s;
        letter-spacing: .02em;
    }
    .btn-save:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 24px rgba(200,16,46,.45);
    }
    .btn-save:active { transform: translateY(0); }
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
                <p class="banner-title">{{ $user->first_name }} {{ $user->last_name }}</p>
                <p class="banner-sub">Donor since {{ $user->created_at->format('Y') }} &nbsp;·&nbsp; Edit your profile</p>
            </div>

            {{-- Avatar strip --}}
            <div class="avatar-strip">
                <div class="avatar-bubble">🩸</div>
                <div class="avatar-name">
                    <h2>{{ $user->first_name }}</h2>
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

                        {{-- Left: Medical --}}
                        <div class="form-col">
                            <p class="section-label">Medical Information</p>

                            <div class="field">
                                <label for="blood_type">Blood Type</label>
                                <div class="select-wrap">
                                    <select id="blood_type" name="blood_type" required>
                                        <option value="" disabled {{ old('blood_type', $user->profile?->blood_type) ? '' : 'selected' }}>Select Blood Type</option>
                                        @foreach(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $type)
                                            <option value="{{ $type }}" {{ old('blood_type', $user->profile?->blood_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('blood_type') <p class="field-error">{{ $message }}</p> @enderror
                            </div>

                            <div class="field">
                                <label for="last_donation_date">Last Donation Date <span style="font-weight:400;text-transform:none;letter-spacing:0;font-size:11px;color:#9C8A90">(optional)</span></label>
                                <input type="date" id="last_donation_date" name="last_donation_date"
                                       value="{{ old('last_donation_date', $user->profile?->last_donation_date) }}">
                                @error('last_donation_date') <p class="field-error">{{ $message }}</p> @enderror
                            </div>

                            <label class="toggle-card">
                                <div class="toggle-text">
                                    <strong>Available to Donate</strong>
                                    <span>Let others see you're ready</span>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" name="available" value="1" {{ old('available', $user->profile?->available ?? true) ? 'checked' : '' }}>
                                    <div class="toggle-track"></div>
                                </div>
                            </label>
                        </div>

                        {{-- Right: Contact --}}
                        <div class="form-col">
                            <p class="section-label">Contact Information</p>

                            <div class="field">
                                <label for="phone">Phone Number</label>
                                <input type="text" id="phone" name="phone"
                                       value="{{ old('phone', $user->profile?->phone) }}"
                                       placeholder="+212 600 000 000" required>
                                @error('phone') <p class="field-error">{{ $message }}</p> @enderror
                            </div>

                            <div class="field">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city"
                                       value="{{ old('city', $user->profile?->city) }}"
                                       placeholder="e.g. Casablanca" required>
                                @error('city') <p class="field-error">{{ $message }}</p> @enderror
                            </div>

                            <div class="info-note">
                                <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 8v4m0 4h.01"/></svg>
                                To change your name or email, please contact support.
                            </div>
                        </div>

                    </div>

                    <div class="form-footer">
                        <a href="{{ url()->previous() }}" class="btn-ghost">Cancel</a>
                        <button type="submit" class="btn-save">Save Changes</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

@endsection