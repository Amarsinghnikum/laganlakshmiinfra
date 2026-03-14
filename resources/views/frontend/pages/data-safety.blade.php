@extends('frontend.layouts.app')

@section('meta_title', 'Data Safety – Lagan Lakshmi Infra')
@section('meta_description', 'Understand how we classify sensitive information, how you can request deletions, and how we keep your account data safe.')
@section('meta_keywords', 'data safety, account deletion, data removal, Google Play, CampusDirect, Lagan Lakshmi Infra')

@section('content')
<div class="page-section data-safety-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content data-safety-content">
                    <h1 class="page-title">Data Safety</h1>
                    <p class="lead">We treat account credentials, authentication flows, and deletion links with the same care you see in Google Play’s Data Safety form. Transparency lets you understand how the data tied to your Campus Direct experience is handled and who to talk to if you need it removed.</p>

                    <div class="content-section">
                        <h2>Tracked data categories</h2>
                        <p>We document the same high-level categories that are visible on Play, so you know exactly what information can be removed when you ask.</p>
                        <ul class="data-safety-checklist">
                            <li>Username, password, and other authentication data</li>
                            <li>OAuth tokens when you sign in through a provider</li>
                            <li>Other personal information you provide to use Campus Direct</li>
                            <li>Account creation is disabled for non-admin users; everyone uses credentials assigned by the developer team</li>
                        </ul>
                        <p class="muted">This mirrors the experience a user sees when the app states “My app does not allow users to create an account” during deployment.</p>
                    </div>

                    <div class="content-section">
                        <h2>How to request deletions</h2>
                        <p>We expose a clear deletion endpoint so your request can be handled without chasing a support ticket. Add the following link on the store listing and on this site.</p>
                        <div class="delete-link">
                            <label>Delete account URL</label>
                            <input type="text" value="https://campusdirect.in/data-deletion" readonly>
                        </div>
                        <ul class="data-safety-guidance">
                            <li>Refer to the Campus Direct name that appears on our store listing so users know exactly whose data they are deleting.</li>
                            <li>Prominently explain the steps: email info@campusdirect.in, confirm the account (phone or email), and request deletion.</li>
                            <li>List which data is deleted (authentication credentials, saved preferences) and what is retained for compliance (audit logs, payment records).</li>
                        </ul>
                        <div class="callout">
                            <strong>Need help with a deletion now?</strong>
                            <p>Email <a href="mailto:info@campusdirect.in">info@campusdirect.in</a> and we will confirm how your account and associated data will be removed.</p>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>User control</h2>
                        <p>We provide a way for users to request that some or all of their data is deleted without forcing account removal. This includes:</p>
                        <ul class="data-safety-checklist">
                            <li>Opting out of marketing communications while keeping access to saved properties.</li>
                            <li>Requesting removal of saved inspections or search preferences.</li>
                            <li>Inquiring about data portability and receiving a CSV of profile details.</li>
                        </ul>
                        <p>We respond to every request within five business days. You can also follow up by calling the office number listed at the bottom of our contact page.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.data-safety-section {
    padding: 120px 0 80px;
    background: linear-gradient(145deg, #f5f7fb 0%, #eef3ff 100%);
}

.data-safety-content {
    border-radius: 20px;
    background: #fff;
    padding: 60px;
    box-shadow:
        0 20px 40px rgba(15, 48, 95, 0.1),
        0 0 0 1px rgba(103, 126, 239, 0.08);
}

.data-safety-content .page-title {
    font-size: 3rem;
    text-align: center;
    margin-bottom: 20px;
    color: #2f3e80;
}

.data-safety-content .lead {
    text-align: center;
    font-size: 1.1rem;
    margin-bottom: 40px;
    color: #555;
    line-height: 1.6;
}

.content-section {
    margin-top: 40px;
}

.content-section h2 {
    font-size: 2rem;
    color: #2f3e80;
    margin-bottom: 20px;
}

.content-section p {
    color: #4b4f5c;
    line-height: 1.8;
}

.data-safety-checklist,
.data-safety-guidance {
    padding-left: 20px;
    margin-top: 20px;
    color: #3b3f4e;
}

.data-safety-checklist li,
.data-safety-guidance li {
    margin-bottom: 12px;
    position: relative;
    line-height: 1.7;
}

.data-safety-checklist li::before,
.data-safety-guidance li::before {
    content: '\\2713';
    position: absolute;
    left: -22px;
    color: #0d6efd;
    font-weight: 700;
}

.delete-link {
    margin-top: 20px;
    margin-bottom: 15px;
}

.delete-link label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #2f3e80;
}

.delete-link input {
    width: 100%;
    padding: 12px 16px;
    border-radius: 8px;
    border: 1px solid #b7c0d9;
    background: #f8f9ff;
    font-weight: 600;
    color: #344674;
}

.callout {
    margin-top: 20px;
    padding: 20px;
    border-radius: 12px;
    background: linear-gradient(135deg, #eef7ff 0%, #d9e6ff 100%);
    border: 1px solid #c0d4ff;
}

.callout strong {
    font-size: 1.1rem;
    display: block;
    margin-bottom: 6px;
}

.callout a {
    color: #0d6efd;
    text-decoration: none;
    font-weight: 600;
}

.muted {
    color: #6c7385;
    font-size: 0.95rem;
}

@media (max-width: 768px) {
    .data-safety-content {
        padding: 40px 30px;
    }

    .data-safety-content .page-title {
        font-size: 2.3rem;
    }
}
</style>
@endpush
