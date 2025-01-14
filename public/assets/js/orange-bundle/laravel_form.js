class Form {
    static getFormWithButton(action, method, buttonHTML) {

        let form = document.createElement('form');
        form.action = action;
        form.method = method.toUpperCase() === "GET" ? "GET" : "POST";

        const csrf = document.createElement('input');
        csrf.type = "hidden";
        csrf.name = "_token";
        csrf.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        form.appendChild(csrf);

        if (method.toUpperCase() !== "GET" && method.toUpperCase() !== "POST") {
            const httpMethod = document.createElement('input');
            httpMethod.type = 'hidden';
            httpMethod.name = "_method";
            httpMethod.value = method.toUpperCase();
            form.appendChild(httpMethod);
        }

        form.innerHTML += buttonHTML;

        return form;
    }

    static getFormWithButtonHTML(action, method, buttonHTML) {
        const form = Form.getFormWithButton(action, method, buttonHTML);
        return form.outerHTML;
    }
}
