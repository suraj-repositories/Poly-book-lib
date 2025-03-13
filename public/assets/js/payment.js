const paymentBtnId = "#makePaymentButton";

document.addEventListener("DOMContentLoaded", () => {
    console.log("Razorpay Payment Initialized");
    new RazorpayPayment().init();
});

class RazorpayPayment {
    init() {
        this.enableRazorpayPaymentBtn(paymentBtnId);
    }

    enableRazorpayPaymentBtn(selector) {
        const btn = document.querySelector(selector);
        if (!btn) return;

        const price = btn.getAttribute("data-price");
        const type = btn.getAttribute("data-model");
        const id = btn.getAttribute("data-model-id");
        const razorpayKey = btn.getAttribute("data-razorpay-key");
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        const appName = document.querySelector('meta[name="app-name"]').getAttribute("content");
        const appLogo = document.querySelector('link[rel="icon"]').getAttribute("href");

        if (!price || !type || !id || !razorpayKey || !csrfToken) {
            console.error("Missing required Razorpay attributes.");
            return;
        }

        btn.addEventListener("click", async () => {
            this.loading(selector, 'enable');
            try {
                const paymentUrl = route("download.payment.widget", { type, id });

                const response = await fetch(paymentUrl, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({ amount: price }),
                });

                const data = await response.json();

                if (data.auth_status) {
                    if (!data.login) {
                        this.loading(selector, 'disable');
                        window.location.href = data.redirect_url;
                        return;
                    }
                }

                if (data.already_purchased) {
                    this.loading(selector, 'disable');
                    window.location.href = data.redirect_url;
                    return;
                }

                if (!data.order_id || !data.amount) {
                    console.error("Invalid response from server:", data);
                    alert("Error: Unable to process payment. Please try again.");
                    this.loading(selector, 'disable');
                    return;
                }

                const self = this;
                const options = {
                    key: razorpayKey,
                    amount: data.amount,
                    name: appName,
                    currency: "INR",
                    order_id: data.order_id,
                    image: appLogo,
                    handler: function (response) {
                        console.log("Payment Successful:", response);
                        window.location.href = route("download.payment.success", {
                            type,
                            id,
                            razorpay_payment_id: response.razorpay_payment_id,
                            razorpay_order_id: response.razorpay_order_id,
                            razorpay_signature: response.razorpay_signature
                        });
                        window.location.reload();


                    },
                    theme: { color: "#FFAC4F" },
                };

                const rzp = new Razorpay(options);
                rzp.open();
                this.loading(selector, 'disable');
            } catch (error) {
                console.error("Payment Error:", error);
                alert("Payment failed. Please check your connection and try again.");
                this.loading(selector, 'disable');
            }
        });
    }

    loading(selector, action) {
        const btn = document.querySelector(selector);
        if (btn) {
            if (action == 'enable') {
                btn.disabled = true;
                btn.classList.add('loading');
            }
            else if (action == 'disable') {
                btn.disabled = false;
                btn.classList.remove('loading');
            }
        }
    }
}
