document.addEventListener('DOMContentLoaded', function () {
    const profileImageInput = document.querySelector('#edit-profile-image');

    profileImageInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const images = document.querySelectorAll('.profile-image-preview');

                images.forEach(img => {
                    img.src = e.target.result;
                });
            };
            reader.readAsDataURL(file);

            const form = event.target.closest('form');
            if (form) {
                updateProfileImage(form);
            }
        }
    });
});

function updateProfileImage(form) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Success:', data.message);
        } else {
            console.error('Error:', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

