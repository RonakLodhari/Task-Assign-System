@extends('layouts.user')

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <div class="container mt-4">
        <div class="profile-card">
            <div class="profile-banner">
                <div class="banner-overlay"></div>
            </div>
            <div class="profile-content">
                <div class="profile-header">
                    <div class="profile-avatar">
                        <img src="{{ asset(auth()->user()->image) }}" alt="Profile Picture">
                        <div class="status-dot"></div>
                    </div>
                    <div class="profile-info">
                        <h1>{{ auth()->user()->fullname }}</h1>
                        <div class="role-badge">{{ ucfirst(auth()->user()->usertype) }}</div>
                        <p class="designation">Backend developer</p>
                        <p class="tagline">Passionate about creating amazing solutions</p>
                    </div>
                </div>

                <div class="profile-meta">
                    <div class="meta-item">
                        <i class="bi bi-calendar3"></i>
                        <span>Joined {{ Carbon::parse(auth()->user()->created_at)->format('M Y') }}</span>
                    </div>
                    <div class="meta-divider"></div>
                    <div class="meta-item">
                        <i class="bi bi-geo-alt"></i>
                        <span>{{ auth()->user()->address ?: 'Ahmedabad, Gujarat, IND' }}</span>
                    </div>
                </div>

                <div class="details-section">
                    <h2><i class="bi bi-person-lines-fill"></i> Personal Information</h2>
                    <div class="details-grid">
                        <div class="detail-item">
                            <label><i class="bi bi-person"></i> Full Name</label>
                            <p>{{ auth()->user()->fullname }}</p>
                        </div>
                        <div class="detail-item">
                            <label><i class="bi bi-envelope"></i> Email</label>
                            <p>{{ auth()->user()->email }}</p>
                        </div>
                        <div class="detail-item">
                            <label><i class="bi bi-telephone"></i> Phone Number</label>
                            <p>{{ auth()->user()->phone ?: 'Not set' }}</p>
                        </div>
                        <div class="detail-item">
                            <label><i class="bi bi-calendar"></i> Date of Birth</label>
                            <p>{{ auth()->user()->dob ? Carbon::parse(auth()->user()->dob)->format('d M, Y') : 'Not set' }}</p>
                        </div>
                        <div class="detail-item">
                            <label><i class="bi bi-shield-check"></i> Role</label>
                            <p>{{ ucfirst(auth()->user()->usertype) }}</p>
                        </div>
                        <div class="detail-item">
                            <label><i class="bi bi-geo"></i> Location</label>
                            <p>{{ auth()->user()->address ?: 'Not set' }}</p>
                        </div>
                    </div>
                </div>

                <div class="statistics-section">
                    <h2><i class="bi bi-graph-up"></i> Statistics</h2>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="bi bi-folder-check"></i>
                            </div>
                            <div class="stat-info">
                                <h3>Total Projects</h3>
                                <div class="stat-number">{{ auth()->user()->assignedProjects->count() }}</div>
                            </div>  
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="bi bi-list-check"></i>
                            </div>
                            <div class="stat-info">
                                <h3>Completed Tasks</h3>
                                <div class="stat-number">{{ auth()->user()->assignedTasks->where('status', 'Completed')->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
body {
    background: linear-gradient(135deg, #e0e7ff 0%, #f0fdfa 100%);
    min-height: 100vh;
}
.profile-card {
    background: rgba(255,255,255,0.85);
    border-radius: 28px;
    overflow: hidden;
    box-shadow: 0 8px 40px rgba(59,130,246,0.13), 0 1.5px 8px rgba(0,0,0,0.04);
    margin-bottom: 30px;
    backdrop-filter: blur(8px);
    border: 1.5px solid #e0e7ef;
    position: relative;
}
.profile-banner {
    height: 220px;
    background: linear-gradient(120deg, #6366f1 0%, #0ea5e9 100%);
    position: relative;
    overflow: hidden;
}
.banner-overlay {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='320' height='220' viewBox='0 0 320 220' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cellipse opacity='0.18' cx='160' cy='110' rx='160' ry='110' fill='%23fff'/%3E%3Cellipse opacity='0.12' cx='80' cy='60' rx='60' ry='40' fill='%230ea5e9'/%3E%3Cellipse opacity='0.10' cx='260' cy='170' rx='50' ry='30' fill='%236366f1'/%3E%3C/svg%3E");
    background-size: cover;
    z-index: 1;
}
.profile-content {
    padding: 0 36px 36px;
    margin-top: -70px;
    position: relative;
    z-index: 2;
}
.profile-header {
    text-align: center;
    margin-bottom: 32px;
}
.profile-avatar {
    position: relative;
    display: inline-block;
    margin-bottom: 18px;
}
.profile-avatar img {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    border: 6px solid #fff;
    background: linear-gradient(135deg, #6366f1 60%, #0ea5e9 100%);
    box-shadow: 0 8px 32px rgba(99,102,241,0.13);
    object-fit: cover;
    transition: transform 0.3s, box-shadow 0.3s;
}
.profile-avatar img:hover {
    transform: scale(1.06) rotate(-2deg);
    box-shadow: 0 12px 40px rgba(99,102,241,0.18);
}
.status-dot {
    position: absolute;
    bottom: 16px;
    right: 18px;
    width: 18px;
    height: 18px;
    background: linear-gradient(135deg, #22c55e 60%, #4ade80 100%);
    border: 3px solid #fff;
    border-radius: 50%;
    box-shadow: 0 2px 8px rgba(34,197,94,0.18);
}
.role-badge {
    display: inline-block;
    padding: 7px 20px;
    background: linear-gradient(90deg, #e0f2fe 60%, #f0fdfa 100%);
    color: #0369a1;
    border-radius: 20px;
    font-size: 15px;
    font-weight: 600;
    margin: 10px 0 6px 0;
    letter-spacing: 0.02em;
    box-shadow: 0 1px 4px rgba(14,165,233,0.07);
}
.profile-info h1 {
    font-size: 2.1rem;
    font-weight: 800;
    color: #22223b;
    margin-bottom: 8px;
    letter-spacing: -1px;
}
.designation {
    color: #64748b;
    font-size: 1.08rem;
    margin-bottom: 4px;
    font-weight: 500;
}
.tagline {
    color: #94a3b8;
    font-size: 1rem;
    font-style: italic;
    margin-bottom: 0;
}
.profile-meta {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 28px;
    margin-bottom: 38px;
    padding: 18px;
    background: rgba(248,250,252,0.95);
    border-radius: 14px;
    box-shadow: 0 1px 8px rgba(59,130,246,0.04);
}
.meta-divider {
    width: 1.5px;
    height: 28px;
    background: #e2e8f0;
}
.meta-item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #64748b;
    font-size: 1.04rem;
}
.meta-item i {
    color: #0ea5e9;
    font-size: 20px;
}
.details-section, .statistics-section {
    background: rgba(255,255,255,0.97);
    border-radius: 18px;
    padding: 28px;
    margin-bottom: 26px;
    box-shadow: 0 2px 12px rgba(99,102,241,0.06);
    border: 1px solid #f1f5f9;
}
.details-section h2, .statistics-section h2 {
    font-size: 1.25rem;
    color: #22223b;
    margin-bottom: 22px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 700;
}
.details-section h2 i, .statistics-section h2 i {
    color: #0ea5e9;
}
.details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 18px;
}
.detail-item {
    padding: 18px;
    background: #f8fafc;
    border-radius: 13px;
    transition: all 0.3s;
    box-shadow: 0 1px 6px rgba(99,102,241,0.04);
    border: 1px solid #e0e7ef;
}
.detail-item:hover {
    transform: translateY(-2px) scale(1.03);
    box-shadow: 0 4px 16px rgba(99,102,241,0.09);
    border-color: #6366f1;
}
.detail-item label {
    display: flex;
    align-items: center;
    gap: 7px;
    color: #64748b;
    font-size: 14px;
    margin-bottom: 8px;
    font-weight: 600;
}
.detail-item label i {
    color: #0ea5e9;
}
.detail-item p {
    color: #22223b;
    font-size: 1.07rem;
    margin: 0;
    font-weight: 500;
}
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 18px;
}
.stat-card {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 22px;
    background: #f8fafc;
    border-radius: 13px;
    transition: all 0.3s;
    border: 1px solid #e0e7ef;
    box-shadow: 0 1px 6px rgba(99,102,241,0.04);
}
.stat-card:hover {
    transform: translateY(-2px) scale(1.03);
    box-shadow: 0 4px 16px rgba(99,102,241,0.09);
    border-color: #6366f1;
}
.stat-icon {
    width: 52px;
    height: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #e0f2fe 60%, #f0fdfa 100%);
    color: #0ea5e9;
    border-radius: 14px;
    font-size: 26px;
    box-shadow: 0 2px 8px rgba(14,165,233,0.07);
}
.stat-info h3 {
    color: #64748b;
    font-size: 15px;
    margin: 0 0 4px 0;
    font-weight: 600;
}
.stat-number {
    color: #22223b;
    font-size: 1.6rem;
    font-weight: 800;
    margin: 0;
    letter-spacing: 1px;
}
@media (max-width: 900px) {
    .profile-content {
        padding: 0 12px 18px;
    }
    .profile-banner {
        height: 140px;
    }
}
@media (max-width: 768px) {
    .profile-content {
        padding: 0 8px 12px;
    }
    .profile-meta {
        flex-direction: column;
        gap: 12px;
    }
    .meta-divider {
        display: none;
    }
    .details-grid, .stats-grid {
        grid-template-columns: 1fr;
    }
    .profile-avatar img {
        width: 100px;
        height: 100px;
    }
}
</style>
@endsection