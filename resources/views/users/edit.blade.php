@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=Jost:wght@300;400;500;600&display=swap');

    :root {
        --ink:        #1A1410;
        --ink-mid:    #4A3F35;
        --ink-soft:   #7A6A54;
        --parchment:  #F8F4EE;
        --parchment2: #F0EAE0;
        --line:       #E2D9CE;
        --gold:       #B8912A;
        --gold-pale:  #F5ECD4;
        --jade:       #2D6A4F;
        --jade-pale:  #D8F3DC;
        --amber:      #C77D2F;
        --amber-pale: #FEF3E2;
        --rose:       #A04545;
        --rose-pale:  #F9ECEC;
        --radius:     14px;
        --radius-sm:  8px;
    }

    .user-page { font-family: 'Jost', sans-serif; color: var(--ink); }

    .user-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 2rem;
        padding-bottom: 1.25rem;
        border-bottom: 1.5px solid var(--line);
    }

    .user-header .eyebrow {
        font-size: 0.68rem;
        font-weight: 600;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--ink-soft);
        margin-bottom: 0.2rem;
    }

    .user-header h2 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem;
        font-weight: 400;
        color: var(--ink);
        margin: 0;
        line-height: 1.1;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: transparent;
        color: var(--ink-soft);
        font-family: 'Jost', sans-serif;
        font-size: 0.84rem;
        font-weight: 500;
        padding: 0.6rem 1.1rem;
        border-radius: 50px;
        text-decoration: none;
        border: 1.5px solid var(--line);
        transition: border-color 0.2s, color 0.2s, transform 0.15s;
        white-space: nowrap;
    }

    .btn-back:hover {
        border-color: var(--ink-mid);
        color: var(--ink);
        transform: translateY(-1px);
    }

    .form-card {
        background: #fff;
        border: 1.5px solid var(--line);
        border-radius: var(--radius);
        padding: 2rem 2rem 2.5rem;
        box-shadow: 0 4px 16px rgba(26,20,16,0.07);
        max-width: 560px;
    }

    /* Edit notice */
    .edit-notice {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        background: var(--amber-pale);
        border: 1px solid #f5d9aa;
        border-radius: var(--radius-sm);
        padding: 0.6rem 0.9rem;
        font-size: 0.8rem;
        color: var(--amber);
        margin-bottom: 1.6rem;
    }

    .form-group { margin-bottom: 1.4rem; }

    .form-group label {
        display: block;
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--ink-soft);
        margin-bottom: 0.45rem;
    }

    .form-control-custom {
        width: 100%;
        background: var(--parchment);
        border: 1.5px solid var(--line);
        border-radius: var(--radius-sm);
        padding: 0.65rem 0.9rem;
        font-family: 'Jost', sans-serif;
        font-size: 0.9rem;
        color: var(--ink);
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        box-sizing: border-box;
        appearance: none;
    }

    .form-control-custom:focus {
        border-color: var(--gold);
        background: #fff;
        box-shadow: 0 0 0 3px var(--gold-pale);
    }

    /* Select wrapper */
    .select-wrapper {
        position: relative;
    }

    .select-wrapper::after {
        content: '';
        position: absolute;
        right: 0.9rem;
        top: 50%;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-top: 5px solid var(--ink-soft);
        pointer-events: none;
    }

    .select-wrapper .form-control-custom {
        padding-right: 2.2rem;
        cursor: pointer;
    }

    /* Password section note */
    .section-label {
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--ink-soft);
        margin-bottom: 0.9rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px dashed var(--line);
    }

    .field-hint {
        font-size: 0.72rem;
        color: var(--ink-soft);
        margin-top: 0.3rem;
    }

    .form-divider {
        height: 1px;
        background: var(--line);
        margin: 1.8rem 0;
    }

    .btn-update {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--ink);
        color: #fff;
        font-family: 'Jost', sans-serif;
        font-size: 0.88rem;
        font-weight: 500;
        padding: 0.7rem 1.6rem;
        border-radius: 50px;
        border: none;
        cursor: pointer;
        transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        box-shadow: 0 2px 8px rgba(26,20,16,0.15);
    }

    .btn-update:hover {
        background: var(--ink-mid);
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(26,20,16,0.22);
    }

    @media (max-width: 560px) {
        .user-header { flex-direction: column; align-items: flex-start; }
        .form-card { padding: 1.4rem 1.2rem 2rem; }
    }
</style>

<div class="user-page">

    <div class="user-header">
        <div>
            <div class="eyebrow">Master Data</div>
            <h2>Edit User</h2>
        </div>
        <a href="/users" class="btn-back">
            <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                <path d="M8 2L4 6.5 8 11" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="form-card">

        <div class="edit-notice">
            <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                <path d="M9 1.5l2 2L4.5 11H2V8.5L9 1.5z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>
            </svg>
            Mengubah data: <strong>{{ $user->name }}</strong>
        </div>

        <form action="/users/{{ $user->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text"
                       id="name"
                       name="name"
                       class="form-control-custom"
                       value="{{ $user->name }}"
                       required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email"
                       id="email"
                       name="email"
                       class="form-control-custom"
                       value="{{ $user->email }}"
                       required>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <div class="select-wrapper">
                    <select id="role" name="role" class="form-control-custom">
                        <option value="admin"     {{ $user->role == 'admin'     ? 'selected' : '' }}>Admin</option>

                        <option value="manager"   {{ $user->role == 'manager'   ? 'selected' : '' }}>Manager</option>
                        <option value="therapist" {{ $user->role == 'therapist' ? 'selected' : '' }}>Therapist</option>
                    </select>
                </div>
            </div>

            <div class="form-divider"></div>

            <div class="section-label">Ganti Password</div>

            <div class="form-group">
                <label for="password">Password Baru</label>
                <input type="password"
                       id="password"
                       name="password"
                       class="form-control-custom"
                       placeholder="Kosongkan jika tidak ingin mengubah">
                <div class="field-hint">Biarkan kosong jika tidak ingin mengubah password.</div>
            </div>

            <div class="form-divider"></div>

            <button type="submit" class="btn-update">
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                    <path d="M2 7l3.5 3.5L11 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Update
            </button>
        </form>
    </div>

</div>

@endsection
