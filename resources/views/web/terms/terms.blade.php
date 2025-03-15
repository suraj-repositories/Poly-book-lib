@extends('layout.layout')
@section('title', Route::is('terms.index') ? 'Terms' : '')

@section('content')
    <main class="main">

        @include('web.terms.terms_bredcrumbs')

        <section id="terms" class="terms section">
            @include('web.terms.terms_heading')

            <div class="container">
                <div class="row gy-4">
                    <div class="col">
                        <p>Welcome to {{ config('app.name') }}! By using our website and purchasing books from us, you agree to
                            the following terms and conditions. Please read them carefully.</p>

                        <h4>1. Acceptance of Terms</h4>
                        <p>By accessing or using {{ config('app.name') }} ( <a href="{{ config('app.url') }}">{{ config('app.url') }}</a> ), you agree to be bound by these Terms and
                            Services ( <a href="{{ url()->current() }}">{{ url()->current() }}</a> ). If you do not agree, please do not use our website.</p>

                        <h4>2. User Accounts</h4>
                        <ul>
                            <li>You may be required to create an account to purchase books.</li>
                            <li>You are responsible for maintaining the confidentiality of your account and password.</li>
                            <li>We reserve the right to suspend or terminate accounts at our discretion.</li>
                        </ul>

                        <h4>3. Purchase and Payments</h4>
                        <ul>
                            <li>All prices are listed in Ruppee (₹) and are subject to change without notice.</li>
                            <li>We accept payments through UPI, Cards, Net banking powered by razorpay.</li>
                            <li>Your purchase is confirmed only after payment is successfully processed.</li>
                        </ul>

                        <h4>4. Intellectual Property</h4>
                        <p>All content on our website, including text, images, and logos, is our property and protected by
                            copyright laws. You may not use our content without prior written consent.</p>

                        <h4>5. Prohibited Activities</h4>
                        <p>Users agree not to:</p>
                        <ul>
                            <li>Engage in fraudulent activities.</li>
                            <li>Copy, distribute, or sell any content without permission.</li>
                            <li>Use automated tools to access or interfere with our website.</li>
                        </ul>

                        <h4>6. Privacy Policy</h4>
                        <p>Your use of our website is also governed by our Privacy Policy, which explains how we collect,
                            use, and protect your data.</p>

                        <h4>7. Limitation of Liability</h4>
                        <ul>
                            <li>We are not liable for any indirect, incidental, or consequential damages.</li>
                            <li>Our maximum liability is limited to the amount you paid for your purchase.</li>
                        </ul>

                        <h4>8. Modifications to Terms</h4>
                        <p>We reserve the right to modify these Terms at any time. Continued use of our website after
                            changes means you accept the new Terms.</p>

                        <h4>9. Contact Information</h4>
                        <p>For any questions about these Terms, please contact us at [Your Email Address].</p>

                        <p>By using our website, you acknowledge that you have read, understood, and agreed to these Terms
                            and Services.</p>
                    </div>
                </div>

            </div>

        </section>

        <x-web.stats />


    </main>
@endsection
