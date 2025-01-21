

class Utility{

    static setUrlParam(key, value){
        const currentUrl = window.location.href;
        const url = new URL(currentUrl);
        url.searchParams.set(key, value);
        window.history.pushState({}, '', url);
    }

    static getUrlParam(key){
        const currentUrl = window.location.href;
        const url = new URL(currentUrl);
        return  url.searchParams.get(key);
    }

    static beforeCloseTabWaitFor(inProgress, message = "Running... Leave?"){
        if (inProgress) {
            e.preventDefault();
            if (!confirm(message)) e.preventDefault();
        }
    }

    static createUUID() {
        var s = [];
        var hexDigits = "0123456789abcdef";
        for (var i = 0; i < 36; i++) {
            s[i] = hexDigits.substring(Math.floor(Math.random() * 0x10), 1);
        }
        s[14] = "4";
        s[19] = hexDigits.substring((s[19] & 0x3) | 0x8, 1);
        s[8] = s[13] = s[18] = s[23] = "-";

        var uuid = s.join("");
        return uuid;
    }
}
