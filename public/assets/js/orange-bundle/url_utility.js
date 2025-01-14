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

}
