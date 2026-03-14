@extends('frontend.layouts.app')

@section('meta_title', 'Data Safety - Lagan Lakshmi Infra')
@section('meta_description', 'Explore how Lagan Lakshmi Infra keeps property and customer data secure, transparent, and under your control.')
@section('meta_keywords', 'data safety, privacy, data protection, Lagan Lakshmi Infra')

@section('content')
<div class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content">
                    <h1 class="page-title">Data Safety at Lagan Lakshmi Infra</h1>
                    <p class="intro-lead">
                        The data that powers your property searches, inquiries, and service requests is handled with care, strong encryption, and ongoing reviews so that your experience stays both helpful and secure.
                    </p>

                    <div class="content-section">
                        <h2>Overview</h2>
                        <p>
                            We limit the data we collect to what is necessary to deliver personalized property suggestions, respond to your questions, and maintain a transparent record of interactions. This page explains how we categorize that information, how we protect it, and how you can exercise control over it.
                        </p>
                    </div>

                    <div class="content-section">
                        <h2>What we collect</h2>
                        <p>
                            When you engage with Lagan Lakshmi Infra, we may collect:
                        </p>
                        <ul>
                            <li>Identification and contact details such as name, email, and phone number provided during inquiries.</li>
                            <li>Property preferences, searches, site visits, and saved shortlists that help us tailor recommendations.</li>
                            <li>Support and service communications, including messages, documents you upload, and notes tied to a request.</li>
                            <li>Device and browsing signals to monitor usage patterns, detect security risks, and improve site performance.</li>
                            <li>Payment, verification, or agreement records when you request or receive services from our team.</li>
                        </ul>
                    </div>

                    <div class="content-section">
                        <h2>How we keep it safe</h2>
                        <p>
                            Our approach combines technical safeguards with operational discipline:
                        </p>
                        <ul>
                            <li>Encryption of data at rest and in transit, especially for financial or personally identifiable information.</li>
                            <li>Access controls that limit who within our team and service vendors can view or edit sensitive fields.</li>
                            <li>Periodic audits, vulnerability scanning, and vendor reviews to ensure each integration follows best practices.</li>
                            <li>Incident response procedures that notify you promptly in the rare event of a breach affecting your data.</li>
                        </ul>
                    </div>

                    <div class="content-section">
                        <h2>Control, access, and corrections</h2>
                        <p>
                            You decide how much of your information we keep and for how long:
                        </p>
                        <ul>
                            <li>Update your profile, preferences, or communication choices from your account dashboard or by emailing our team.</li>
                            <li>Request a copy of the data we hold about you, including saved property details or conversation history.</li>
                            <li>Ask for corrections to any inaccurate or incomplete information.</li>
                            <li>Opt out of marketing updates while continuing to receive service-critical notifications.</li>
                        </ul>
                        <p>
                            We respond to every request within five business days and may ask for verification to keep your data protected while honoring your preferences.
                        </p>
                    </div>

                    <div class="content-section">
                        <h2>Deletion requests &amp; support</h2>
                        <p>
                            To request deletion of any data we store, visit <a href="https://laganlakshmiinfra.com/data-deletion" target="_blank" rel="noreferrer">https://laganlakshmiinfra.com/data-deletion</a> and follow the instructions. Include any identifiers (email, phone, property reference) that help us locate your information quickly.
                        </p>
                        <p>
                            Once we verify your request, we will remove all deletable data from our systems and notify you when the process completes. If we must retain information for legal, compliance, or dispute reasons, we will explain the exception and how long we expect to keep it.
                        </p>
                        <div class="callout">
                            <strong>Need help right away?</strong>
                            <p>
                                Email <a href="mailto:info@laganlakshmiinfra.com">info@laganlakshmiinfra.com</a> or call <strong>+91 85955 43869</strong> and we will confirm how your data and any associated accounts will be handled.
                            </p>
                        </div>
                    </div>

                    <p><strong>Last Updated:</strong> {{ date('F j, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.page-section {
    padding: 120px 0 80px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    position: relative;
    overflow: hidden;
}

.page-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(103, 126, 239, 0.03) 0%, rgba(103, 126, 239, 0.06) 100%);
    pointer-events: none;
}

.page-content {
    background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
    padding: 60px;
    border-radius: 20px;
    box-shadow:
        0 20px 40px rgba(0, 0, 0, 0.1),
        0 10px 20px rgba(0, 0, 0, 0.06),
        0 0 0 1px rgba(103, 126, 239, 0.08);
    position: relative;
    border: 1px solid rgba(103, 126, 239, 0.1);
    backdrop-filter: blur(10px);
}

.page-title {
    color: #2c3e50;
    margin-bottom: 30px;
    font-size: 3.2rem;
    font-weight: 700;
    text-align: center;
    background: linear-gradient(135deg, #6777ef 0%, #4a5bcf 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    position: relative;
}

.page-title::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #6777ef 0%, #4a5bcf 100%);
    border-radius: 2px;
}

.intro-lead {
    text-align: center;
    color: #555;
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 40px;
    max-width: 860px;
    margin-left: auto;
    margin-right: auto;
}

.content-section {
    position: relative;
    margin-top: 35px;
}

.content-section h2 {
    color: #2c3e50;
    font-size: 1.9rem;
    font-weight: 600;
    margin-bottom: 18px;
    position: relative;
    padding-left: 36px;
}

.content-section h2::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 18px;
    height: 18px;
    background: linear-gradient(135deg, #6777ef 0%, #4a5bcf 100%);
    border-radius: 5px;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
}

.content-section p {
    color: #4b4f5c;
    line-height: 1.8;
    margin-bottom: 20px;
    font-size: 1.05rem;
}

.content-section ul {
    margin-top: 10px;
    padding-left: 26px;
    margin-bottom: 20px;
}

.content-section li {
    margin-bottom: 12px;
    color: #555;
    position: relative;
    line-height: 1.7;
    padding-left: 20px;
}

.content-section li::before {
    content: '';
    position: absolute;
    left: -26px;
    top: 12px;
    width: 12px;
    height: 12px;
    border-radius: 4px;
    background: linear-gradient(135deg, #6777ef 0%, #4a5bcf 100%);
}

.callout {
    margin-top: 20px;
    padding: 24px;
    border-radius: 14px;
    background: linear-gradient(135deg, #eef7ff 0%, #d9e6ff 100%);
    border: 1px solid #c0d4ff;
}

.callout strong {
    display: block;
    margin-bottom: 6px;
    font-size: 1.1rem;
    color: #2c3e50;
}

.callout a {
    color: #0d6efd;
    text-decoration: none;
    font-weight: 600;
}

.content-section a {
    color: #4a5bcf;
    font-weight: 600;
}

.content-section p strong {
    color: #2c3e50;
}

@media (max-width: 768px) {
    .page-section {
        padding: 100px 0 60px;
    }

    .page-content {
        padding: 40px 30px;
        margin: 0 15px;
        border-radius: 15px;
    }

    .page-title {
        font-size: 2.5rem;
        margin-bottom: 25px;
    }

    .content-section {
        margin-top: 30px;
    }

    .content-section h2 {
        font-size: 1.6rem;
        padding-left: 32px;
    }
}

.content-section h2:hover::before,
.content-section li:hover::before {
    transform: translateY(-50%) scale(1.1);
    transition: transform 0.3s ease;
}

* {
    transition: all 0.3s ease;
}
</style>
@endpush
