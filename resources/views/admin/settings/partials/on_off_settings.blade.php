<div class="card">

    <div class="card-body" id="on-off-settings">

        <h4>Settings</h4>

        <div class="form-check form-checkbox-warning py-2 my-2 dash-bottom-border dash-top-border">
            <input type="checkbox" class="form-check-input" id="registrationMail" name="registration_mail"
                {{ Settings::get('registration_mail', 'off') == 'on' ? 'checked' : '' }}>
            <label class="form-check-label" for="registrationMail">Send Email on User
                Registration</label>
        </div>
        <div class="form-check form-checkbox-warning pb-2 mb-2 dash-bottom-border">
            <input type="checkbox" class="form-check-input" id="mailtainence" name="maintainence_mode"
                {{ Settings::get('maintainence_mode', 'off') == 'on' ? 'checked' : '' }}>
            <label class="form-check-label" for="mailtainence">Site Maintenance Mode</label>
        </div>
        <div class="form-check form-checkbox-warning pb-2 mb-2 dash-bottom-border">
            <input type="checkbox" class="form-check-input" id="social_login" name="social_login"
                {{ Settings::get('social_login', 'off') == 'on' ? 'checked' : '' }}>
            <label class="form-check-label" for="social_login"> Enable Social Login (Google,
                Facebook, etc.)</label>
        </div>
        <div class="form-check form-checkbox-warning pb-2 mb-2 dash-bottom-border">
            <input type="checkbox" class="form-check-input" id="social_registeration" name="social_registrtion"
                {{ Settings::get('social_registrtion', 'off') == 'on' ? 'checked' : '' }}>
            <label class="form-check-label" for="social_registeration"> Enable Social Registration (Google,
                Facebook, etc.)</label>
        </div>
        <div class="form-check form-checkbox-warning pb-2 mb-2 dash-bottom-border">
            <input type="checkbox" class="form-check-input" id="guest_downloads" name="guest_download"
                {{ Settings::get('guest_download', 'off') == 'on' ? 'checked' : '' }}>
            <label class="form-check-label" for="guest_downloads">Allow Guest Downloads</label>
        </div>
        <div class="form-check form-checkbox-warning pb-2 mb-2 dash-bottom-border">
            <input type="checkbox" class="form-check-input" id="social_media_sharing" name="social_media_sharing"
                {{ Settings::get('social_media_sharing', 'off') == 'on' ? 'checked' : '' }}>
            <label class="form-check-label" for="social_media_sharing"> Enable Social Media Sharing
                Buttons</label>
        </div>

    </div>
</div>
