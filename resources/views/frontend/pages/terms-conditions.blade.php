@extends('frontend.layouts.app')

@section('meta_title', 'Terms & Conditions - Lagan Lakshmi Infra')
@section('meta_description', 'Read our terms and conditions to understand the rules and guidelines for using our services.')
@section('meta_keywords', 'terms and conditions, terms of service, user agreement, Lagan Lakshmi Infra')

@section('content')
<div class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content">
                    <h1 class="page-title">Terms & Conditions</h1>

                    <div class="content-section">
                        <h2>Acceptance of Terms</h2>
                        <p>By accessing and using the Lagan Lakshmi Infra website and services, you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.</p>

                        <h2>Use License</h2>
                        <p>Permission is granted to temporarily download one copy of the materials on Lagan Lakshmi Infra's website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:</p>
                        <ul>
                            <li>Modify or copy the materials</li>
                            <li>Use the materials for any commercial purpose or for any public display</li>
                            <li>Attempt to decompile or reverse engineer any software contained on the website</li>
                            <li>Remove any copyright or other proprietary notations from the materials</li>
                        </ul>

                        <h2>User Accounts</h2>
                        <p>When you create an account with us, you must provide information that is accurate, complete, and current at all times. You are responsible for safeguarding the password and for all activities that occur under your account.</p>

                        <h2>Property Listings</h2>
                        <h3>Accuracy of Information</h3>
                        <p>While we strive to provide accurate property information, we cannot guarantee the accuracy, completeness, or reliability of any property listings. Users should verify all information independently.</p>

                        <h3>User-Generated Content</h3>
                        <p>By posting content on our platform, you grant us a non-exclusive, royalty-free, perpetual, and worldwide license to use, display, and distribute your content in connection with our services.</p>

                        <h2>Prohibited Uses</h2>
                        <p>You may not use our services:</p>
                        <ul>
                            <li>For any unlawful purpose or to solicit others to perform unlawful acts</li>
                            <li>To violate any international, federal, provincial, or state regulations, rules, laws, or local ordinances</li>
                            <li>To infringe upon or violate our intellectual property rights or the intellectual property rights of others</li>
                            <li>To harass, abuse, insult, harm, defame, slander, disparage, intimidate, or discriminate</li>
                            <li>To submit false or misleading information</li>
                            <li>To upload or transmit viruses or any other type of malicious code</li>
                        </ul>

                        <h2>Service Availability</h2>
                        <p>We reserve the right to withdraw or amend our service, and any service or material we provide on the website, in our sole discretion without notice. We will not be liable if for any reason all or any part of the website is unavailable at any time or for any period.</p>

                        <h2>Disclaimer</h2>
                        <p>The information on this website is provided on an 'as is' basis. To the fullest extent permitted by law, Lagan Lakshmi Infra excludes all representations, warranties, conditions, and terms whether express or implied, statutory or otherwise.</p>

                        <h2>Limitations</h2>
                        <p>In no event shall Lagan Lakshmi Infra, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses.</p>

                        <h2>Indemnification</h2>
                        <p>You hereby indemnify Lagan Lakshmi Infra and undertake to keep Lagan Lakshmi Infra indemnified from and against any losses, damages, costs, liabilities, and expenses (including without limitation legal expenses and any amounts paid by Lagan Lakshmi Infra to a third party in settlement of a claim or dispute) incurred or suffered by Lagan Lakshmi Infra arising out of any breach by you of any provision of these terms.</p>

                        <h2>Termination</h2>
                        <p>We may terminate or suspend your account and bar access to the service immediately, without prior notice or liability, under our sole discretion, for any reason whatsoever and without limitation, including but not limited to a breach of the Terms.</p>

                        <h2>Governing Law</h2>
                        <p>These Terms shall be interpreted and governed by the laws of the jurisdiction in which Lagan Lakshmi Infra operates, without regard to its conflict of law provisions.</p>

                        <h2>Changes to Terms</h2>
                        <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material, we will try to provide at least 30 days notice prior to any new terms taking effect.</p>

                        <h2>Contact Information</h2>
                        <p>If you have any questions about these Terms & Conditions, please contact us at:</p>
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
/* Premium Terms & Conditions Styling */
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
    content: '⚖️';
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
    content: '→';
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