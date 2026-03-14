@extends('frontend.layouts.app')

@section('meta_title', 'Privacy Policy - Lagan Lakshmi Infra')
@section('meta_description', 'Read our privacy policy to understand how we collect, use, and protect your personal information.')
@section('meta_keywords', 'privacy policy, data protection, personal information, Lagan Lakshmi Infra')

@section('content')
<div class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content">
                    <h1 class="page-title">Privacy Policy</h1>

                    <div class="content-section">
                        <h2>Introduction</h2>
                        <p>At Lagan Lakshmi Infra, we are committed to protecting your privacy and ensuring the security of your personal information. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our services.</p>

                        <h2>Information We Collect</h2>
                        <h3>Personal Information</h3>
                        <p>We may collect personal information that you provide directly to us, including:</p>
                        <ul>
                            <li>Name and contact information (email address, phone number)</li>
                            <li>Account information (username, password)</li>
                            <li>Property preferences and search history</li>
                            <li>Communication preferences</li>
                        </ul>

                        <h3>Automatically Collected Information</h3>
                        <p>When you visit our website, we may automatically collect certain information, including:</p>
                        <ul>
                            <li>IP address and location information</li>
                            <li>Browser type and version</li>
                            <li>Pages visited and time spent on our site</li>
                            <li>Device information</li>
                        </ul>

                        <h2>How We Use Your Information</h2>
                        <p>We use the information we collect to:</p>
                        <ul>
                            <li>Provide and improve our services</li>
                            <li>Communicate with you about our services</li>
                            <li>Process transactions and send related information</li>
                            <li>Send marketing communications (with your consent)</li>
                            <li>Analyze website usage and improve user experience</li>
                            <li>Comply with legal obligations</li>
                        </ul>

                        <h2>Information Sharing</h2>
                        <p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except as described in this policy:</p>
                        <ul>
                            <li>With service providers who assist us in operating our website</li>
                            <li>When required by law or to protect our rights</li>
                            <li>In connection with a business transfer or merger</li>
                        </ul>

                        <h2>Data Security</h2>
                        <p>We implement appropriate security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the internet is 100% secure.</p>

                        <h2>Your Rights</h2>
                        <p>You have the right to:</p>
                        <ul>
                            <li>Access and update your personal information</li>
                            <li>Request deletion of your data</li>
                            <li>Opt out of marketing communications</li>
                            <li>Request data portability</li>
                        </ul>

                        <h2>Cookies</h2>
                        <p>We use cookies and similar technologies to enhance your browsing experience, analyze website traffic, and personalize content. You can control cookie settings through your browser preferences.</p>

                        <h2>Third-Party Links</h2>
                        <p>Our website may contain links to third-party websites. We are not responsible for the privacy practices of these external sites.</p>

                        <h2>Children's Privacy</h2>
                        <p>Our services are not intended for children under 13. We do not knowingly collect personal information from children under 13.</p>

                        <h2>Changes to This Policy</h2>
                        <p>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new policy on this page and updating the "Last Updated" date.</p>

                        <h2>Contact Us</h2>
                        <p>If you have any questions about this Privacy Policy, please contact us at:</p>
                        <p>Email: info@laganlakshmiinfra.com<br>
                        Phone: +918595543869</p>

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
/* Premium Privacy Policy Styling */
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
    content: '📋';
    position: absolute;
    left: 0;
    top: 0;
    font-size: 1.4rem;
    opacity: 0.8;
}

.content-section h3 {
    color: #34495e;
    margin-top: 35px;
    margin-bottom: 18px;
    font-size: 1.3rem;
    font-weight: 600;
    position: relative;
    padding-left: 25px;
}

.content-section h3::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 6px;
    height: 6px;
    background: linear-gradient(45deg, #6777ef, #4a5bcf);
    border-radius: 50%;
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

/* Special styling for contact information */
.content-section p strong {
    color: #2c3e50;
    font-weight: 600;
}

/* Responsive design */
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

    .content-section h3 {
        font-size: 1.2rem;
        padding-left: 20px;
    }
}

/* Hover effects */
.content-section h2:hover::before {
    transform: scale(1.1);
    transition: transform 0.3s ease;
}

.content-section h3:hover::before {
    transform: scale(1.2) translateY(-50%);
    transition: transform 0.3s ease;
}

/* Smooth transitions */
* {
    transition: all 0.3s ease;
}
</style>
@endpush