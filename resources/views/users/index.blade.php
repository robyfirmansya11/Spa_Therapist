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
        --sky:        #2563A8;
        --sky-pale:   #E8F0FB;
        --radius:     14px;
        --radius-sm:  8px;
    }

    .user-page { font-family: 'Jost', sans-serif; color: var(--ink); }

    /* Header */
    .user-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1.5rem;
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

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--ink);
        color: #fff;
        font-family: 'Jost', sans-serif;
        font-size: 0.84rem;
        font-weight: 500;
        padding: 0.6rem 1.25rem;
        border-radius: 50px;
        text-decoration: none;
        transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        box-shadow: 0 2px 8px rgba(26,20,16,0.15);
        white-space: nowrap;
    }

    .btn-add:hover {
        background: var(--ink-mid);
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(26,20,16,0.22);
    }

    /* Alert */
    .alert-success-custom {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        background: var(--jade-pale);
        border: 1px solid #a8d5b5;
        border-radius: var(--radius-sm);
        padding: 0.7rem 1rem;
        font-size: 0.84rem;
        color: var(--jade);
        margin-bottom: 1.4rem;
    }

    /* Table card */
    .table-card {
        background: #fff;
        border: 1.5px solid var(--line);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(26,20,16,0.07);
    }

    .user-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }

    .user-table thead th {
        font-size: 0.68rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--ink-soft);
        background: var(--parchment2);
        padding: 0.85rem 1.1rem;
        border-bottom: 1.5px solid var(--line);
        white-space: nowrap;
    }

    .user-table thead th:first-child { padding-left: 1.5rem; }
    .user-table thead th:last-child  { padding-right: 1.5rem; }

    .user-table tbody tr {
        border-bottom: 1px solid var(--line);
        transition: background 0.15s;
    }

    .user-table tbody tr:last-child { border-bottom: none; }
    .user-table tbody tr:hover { background: var(--parchment); }

    .user-table tbody td {
        padding: 0.9rem 1.1rem;
        vertical-align: middle;
    }

    .user-table tbody td:first-child { padding-left: 1.5rem; }
    .user-table tbody td:last-child  { padding-right: 1.5rem; }

    /* User name with avatar */
    .user-name {
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .user-avatar {
        width: 30px; height: 30px;
        background: var(--sky-pale);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: var(--sky);
        font-family: 'Jost', sans-serif;
        font-size: 0.75rem;
        font-weight: 600;
        flex-shrink: 0;
        text-transform: uppercase;
    }

    .user-name-text {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.1rem;
        font-weight: 400;
        color: var(--ink);
    }

    /* Email */
    .email-text {
        font-size: 0.82rem;
        color: var(--ink-soft);
    }

    /* Role badge */
    .role-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        border-radius: 50px;
        padding: 0.2rem 0.65rem;
        font-size: 0.75rem;
        font-weight: 500;
        white-space: nowrap;
        text-transform: capitalize;
    }

    .role-admin    { background: var(--rose-pale);  color: var(--rose);  border: 1px solid #f0c4c4; }
    .role-manager  { background: var(--gold-pale);  color: var(--gold);  border: 1px solid #e8d49a; }
    .role-therapist{ background: var(--jade-pale);  color: var(--jade);  border: 1px solid #a8d5b5; }
    .role-cashier  { background: var(--sky-pale);   color: var(--sky);   border: 1px solid #b3cff0; }
    .role-default  { background: var(--parchment2); color: var(--ink-mid); border: 1px solid var(--line); }

    /* Actions */
    .action-cell { display: flex; gap: 0.4rem; align-items: center; }

    .btn-edit {
        display: inline-flex; align-items: center; gap: 0.3rem;
        background: var(--amber-pale); color: var(--amber);
        border: 1px solid #f5d9aa;
        font-family: 'Jost', sans-serif; font-size: 0.75rem; font-weight: 500;
        padding: 0.3rem 0.7rem; border-radius: 6px; text-decoration: none;
        transition: background 0.18s, transform 0.15s;
    }
    .btn-edit:hover { background: #f5e0c0; color: var(--amber); transform: translateY(-1px); }

    .btn-delete {
        display: inline-flex; align-items: center; gap: 0.3rem;
        background: var(--rose-pale); color: var(--rose);
        border: 1px solid #f0c4c4;
        font-family: 'Jost', sans-serif; font-size: 0.75rem; font-weight: 500;
        padding: 0.3rem 0.7rem; border-radius: 6px; cursor: pointer;
        transition: background 0.18s, transform 0.15s;
    }
    .btn-delete:hover { background: #f5d0cc; transform: translateY(-1px); }

    /* Empty */
    .empty-state { text-align: center; padding: 4rem 2rem; color: var(--ink-soft); }
    .empty-state svg { opacity: 0.35; margin-bottom: 1rem; }
    .empty-state p { font-size: 0.88rem; }

    .table-wrapper { overflow-x: auto; }

    @media (max-width: 560px) {
        .user-header { flex-direction: column; align-items: flex-start; }
    }
</style>

<div class="user-page">

    <div class="user-header">
        <div>
            <div class="eyebrow">Master Data</div>
            <h2>Data User</h2>
        </div>
        <a href="/users/create" class="btn-add">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M7 1v12M1 7h12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Tambah User
        </a>
    </div>

    @if(session('success'))
        <div class="alert-success-custom">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M2 7.5l3.5 3.5L12 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="table-card">
        <div class="table-wrapper">
            <table class="user-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>
                            <div class="user-name">
                                <div class="user-avatar">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <span class="user-name-text">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td><span class="email-text">{{ $user->email }}</span></td>
                        <td>
                            @php
                                $roleClass = match($user->role) {
                                    'admin'     => 'role-admin',
                                    'manager'   => 'role-manager',
                                    'therapist' => 'role-therapist',
                                    'cashier'   => 'role-cashier',
                                    default     => 'role-default',
                                };
                            @endphp
                            <span class="role-badge {{ $roleClass }}">{{ $user->role }}</span>
                        </td>
                        <td>
                            <div class="action-cell">
                                <a href="/users/{{ $user->id }}/edit" class="btn-edit">
                                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none">
                                        <path d="M7.5 1.5l2 2L3 10H1V8L7.5 1.5z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/>
                                    </svg>
                                    Edit
                                </a>
                                <form action="/users/{{ $user->id }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete"
                                            onclick="return confirm('Yakin ingin menghapus user ini?')">
                                        <svg width="11" height="11" viewBox="0 0 11 11" fill="none">
                                            <path d="M1.5 3h8M4 3V2h3v1M2.5 3l.5 6.5h5L9 3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <svg width="44" height="44" viewBox="0 0 44 44" fill="none">
                                    <circle cx="22" cy="16" r="8" stroke="currentColor" stroke-width="2"/>
                                    <path d="M6 40c0-8.837 7.163-16 16-16s16 7.163 16 16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                                <p>Belum ada data user.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
