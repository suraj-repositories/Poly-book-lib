<div class="help-box d-flex flex-column justify-content-center align-items-center">
    <i class="bi bi-headset help-icon"></i>
    <h4>Have a Question?</h4>
    <p class="d-flex align-items-center mt-2 mb-0">
        <i class="bi bi-telephone me-2"></i>
        <span>{{ Settings::get('primary_contact', config('app.priary_contact')) }}</span></p>
    <p class="d-flex align-items-center mt-1 mb-0">
        <i class="bi bi-envelope me-2"></i>
        <a href="mailto:{{ Settings::get('email', config('app.email')) }}">{{ Settings::get('email', config('app.email')) }}</a>
    </p>
</div>
