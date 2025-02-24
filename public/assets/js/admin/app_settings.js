
document.addEventListener('DOMContentLoaded', () => {
    enableOnOffSettings();
});

function enableOnOffSettings() {
    let checkboxes = document.querySelectorAll('#on-off-settings input[type="checkbox"]');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    checkboxes.forEach(checkbox => {


        checkbox.addEventListener('change', () => {
            const key = checkbox.name;
            const value = checkbox.checked ? "on" : "off";

            fetch(route('admin.on_off_setting.save'), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'x-csrf-token': csrfToken
                },
                body: JSON.stringify({ key: key, value: value })
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    if(data.status === "success"){
                        Toastify({
                            newWindow: true,
                            text: data.message,
                            gravity: 'top',
                            position: 'right',
                            className: "bg-success" ,
                            stopOnFocus: true,
                            offset: {
                                x: 0,
                                y: 0,
                            },
                            duration: 3000,
                            close: true,
                        }).showToast();
                    }


                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
}
