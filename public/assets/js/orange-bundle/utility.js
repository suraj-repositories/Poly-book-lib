

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

    static secondsToTime(seconds) {
        const days = Math.floor(seconds / (24 * 60 * 60));
        const hours = Math.floor((seconds % (24 * 60 * 60)) / (60 * 60));
        const minutes = Math.floor((seconds % (60 * 60)) / 60);
        const remainingSeconds = seconds % 60;

        return { days, hours, minutes, seconds: remainingSeconds };
      }

    static formatTimeFromSeconds(seconds){
        const days = Math.floor(seconds / (24 * 60 * 60));
        const hours = Math.floor((seconds % (24 * 60 * 60)) / (60 * 60));
        const minutes = Math.floor((seconds % (60 * 60)) / 60);
        const remainingSeconds = seconds % 60;

        const timeParts = [];

        if (days > 0) {
            timeParts.push(`${days} day${days > 1 ? 's' : ''}`);
        }
        if (hours > 0) {
            timeParts.push(`${hours} hour${hours > 1 ? 's' : ''}`);
        }
        if (minutes > 0) {
            timeParts.push(`${minutes} minute${minutes > 1 ? 's' : ''}`);
        }
        if (remainingSeconds > 0) {
            timeParts.push(`${remainingSeconds} second${remainingSeconds > 1 ? 's' : ''}`);
        }

        return timeParts.join(', ');
    }


    static convertGoogleMapsUrl(shareUrl) {
        let match = fullUrl.match(/@([-.\d]+),([-.\d]+)/);
        if (match) {
            let lat = match[1];
            let lng = match[2];

            return `https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10000!2d${lng}!3d${lat}!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin`;
        }
        return null;
    }
}
