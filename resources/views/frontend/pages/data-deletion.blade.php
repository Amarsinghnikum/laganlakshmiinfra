@extends('frontend.layouts.app')

@section('meta_title', 'Data Deletion - Lagan Lakshmi Infra')
@section('meta_description', 'Learn how to request deletion of your personal data from Lagan Lakshmi Infra and the safeguards around that process.')
@section('meta_keywords', 'data deletion, right to erasure, personal data, Lagan Lakshmi Infra')

@section('content')
<div class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content">
                    <h1 class="page-title">Data Deletion &amp; Erasure</h1>

                    <div class="content-section">
                        <h2>Overview</h2>
                        <p>Lagan Lakshmi Infra gives you the right to request the deletion of personal information that we hold about you when it is no longer needed for the purpose it was collected, when you withdraw consent, or when the law gives you a right to erasure. This page explains how to make that request and what happens next.</p>

                        <h2>When We Can Remove Your Data</h2>
                        <ul>
                            <li>The information is no longer necessary for the service you requested.</li>
                            <li>You withdraw any consent that we relied upon to process the data.</li>
                            <li>You object to our processing and there are no overriding legitimate grounds.</li>
                            <li>The personal data has been unlawfully processed.</li>
                            <li>Deletion is required by an applicable law or regulation.</li>
                        </ul>

                        <h2>How to Request Deletion</h2>
                        <p>Email your request to <strong>info@laganlakshmiinfra.com</strong> or call <strong>+91 85955 43869</strong>. Please include:</p>
                        <ul>
                            <li>Your full name and the email address or phone number associated with the data.</li>
                            <li>A clear description of the data you want deleted (e.g., newsletter subscription, inquiry history, property interest).</li>
                            <li>Any relevant supporting documents to confirm your identity.</li>
                        </ul>

                        <h2>Verification &amp; Timeline</h2>
                        <p>We will acknowledge your request within 3 business days and may need to verify your identity or clarify the request before proceeding. Once verified, we aim to complete the deletion within 30 days. If we are unable to fulfill your request (for example, due to a legal obligation or dispute), we will explain the reason and inform you of any available options, including internal appeal or supervisory authority contact.</p>

                        <h2>Exceptions and What We May Keep</h2>
                        <ul>
                            <li>We may retain minimal information to comply with legal obligations (e.g., tax, accounting, disputes).</li>
                            <li>We might need to keep anonymized or aggregated data that no longer identifies you personally.</li>
                            <li>Certain records may be retained if they are necessary to defend legal claims or to protect the rights of our business.</li>
                        </ul>

                        <h2>Data Held by Third Parties</h2>
                        <p>If your data lives with a service provider acting on our behalf (such as mailing tools or analytics platforms), we will coordinate with them to honor your deletion request and ensure any processed copies are disposed of securely.</p>

                        <h2>Still Have Questions?</h2>
                        <p>You can also write to us at:</p>
                        <p>Lagan Lakshmi Infra<br>
                        Email: <strong>info@laganlakshmiinfra.com</strong><br>
                        Phone: <strong>+91 85955 43869</strong></p>

                        <p><strong>Last Updated:</strong> {{ date('F j, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Data Deletion Styling matching the privacy policy aesthetic */
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
    margin-bottom: 40px;
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

.content-section {
    position: relative;
}

.content-section h2 {
    color: #2c3e50;
    margin-top: 50px;
    margin-bottom: 25px;
    font-size: 1.8rem;
    font-weight: 600;
    position: relative;
    padding-left: 30px;
}

.content-section h2::before {
    content: '‹';
    position: absolute;
    left: 0;
    top: 0;
    font-size: 1.4rem;
    opacity: 0.8;
}

.content-section p {
    line-height: 1.8;
    margin-bottom: 20px;
    color: #555;
    font-size: 1.05rem;
}

.content-section ul {
    margin-bottom: 25px;
    padding-left: 25px;
}

.content-section li {
    margin-bottom: 12px;
    color: #666;
    position: relative;
    line-height: 1.6;
}

.content-section li::before {
    content: '✓';
    position: absolute;
    left: -25px;
    top: 0;
    color: #6777ef;
    font-weight: bold;
    font-size: 0.9rem;
}

.content-section p strong {
    color: #2c3e50;
    font-weight: 600;
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
        margin-bottom: 30px;
    }

    .content-section h2 {
        font-size: 1.5rem;
        margin-top: 40px;
        padding-left: 25px;
    }
}

.content-section h2:hover::before {
    transform: scale(1.1);
    transition: transform 0.3s ease;
}

* {
    transition: all 0.3s ease;
}
</style>
@endpush
