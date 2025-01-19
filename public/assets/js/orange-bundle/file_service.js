
class FileService {
    static #file = null;
    static #extensions = [
        "aac", "ai", "bmp", "cs", "css", "csv", "doc", "docx",
        "exe", "gif", "heic", "html", "java", "jpg", "jpeg",
        "js", "json", "jsx", "key", "m4p", "md", "mid", "mkv",
        "mov", "mp3", "mp4", "otf", "pdf", "php", "png", "ppt",
        "pptx", "psd", "py", "raw", "rb", "rtf", "sass", "scss",
        "sh", "sql", "svg", "tar", "ttf", "txt",
        "wav", "woff", "xls", "xlsx", "xml", "yml", "zip", "rar"
    ];

    static #bootstrapIcons = [
        "bi-filetype-aac", "bi-filetype-ai", "bi-filetype-bmp", "bi-filetype-cs",
        "bi-filetype-css", "bi-filetype-csv", "bi-filetype-doc", "bi-filetype-docx",
        "bi-filetype-exe", "bi-filetype-gif", "bi-filetype-heic", "bi-filetype-html",
        "bi-filetype-java", "bi-filetype-jpg", "bi-filetype-jpg", "bi-filetype-js",
        "bi-filetype-json", "bi-filetype-jsx", "bi-filetype-key", "bi-filetype-m4p",
        "bi-filetype-md", "bi-file-earmark-music", "bi-file-earmark-play", "bi-filetype-mov",
        "bi-filetype-mp3", "bi-filetype-mp4", "bi-filetype-otf", "bi-filetype-pdf",
        "bi-filetype-php", "bi-filetype-png", "bi-filetype-ppt", "bi-filetype-pptx",
        "bi-filetype-psd", "bi-filetype-py", "bi-filetype-raw", "bi-filetype-rb",
        "bi-file-earmark-text", "bi-filetype-sass", "bi-filetype-scss", "bi-filetype-sh",
        "bi-filetype-sql", "bi-filetype-svg", "bi-file-zip",
        "bi-filetype-ttf", "bi-filetype-txt", "bi-filetype-wav",
        "bi-filetype-woff", "bi-filetype-xls", "bi-filetype-xlsx", "bi-filetype-xml",
        "bi-filetype-yml", "bi-file-earmark-zip", "bi-file-zip-fill"
    ];

    static #defaultBootstrapIcon = "bi-file-earmark";


    constructor(file) {
        FileService.#file = file;
    }

    getSize(file = FileService.#file) {

        console.log(file);
        try {
            if (!file) {
                return '-';
            }


            const units = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
            let fileSize = file.size;

            if (isNaN(fileSize) || fileSize < 0) {
                return '-';
            }

            let i = 0;
            while (fileSize > 900 && i < units.length - 1) {
                fileSize /= 1024;
                i++;
            }

            return `${Math.round(fileSize * 100) / 100} ${units[i]}`;
        } catch (error) {
            return '-';
        }
    }

    getName(file = FileService.#file) {
        return file.name;
    }

    getType(file = FileService.#file) {
        return file.type;
    }

    getExtension(file = FileService.#file) {

        const name = this.getName(file);
        if (name.indexOf('.') > -1) {
            return name.substring(name.lastIndexOf('.') + 1).toUpperCase();
        }
        const type = this.getType(file);
        if (type == "") {
            return "-";
        }
        return type.substring(type.lastIndexOf('/') + 1).toUpperCase();

    }

    getIconFromExtension(extension) {
        const index = FileService.#extensions.indexOf(extension.toLowerCase());
        if (index > -1) {
            return FileService.#bootstrapIcons[index];
        }
        return FileService.#defaultBootstrapIcon;
    }

    getAllAvailableIcons() {

        FileService.#bootstrapIcons.push(FileService.#defaultBootstrapIcon);
        return FileService.#bootstrapIcons;

    }

    setImageOnView(file = FileService.#file, img) {

        const allowedExtensions = ["jpg", "jpeg", "png", "gif", "svg", "webp", "ico"];
        const fileName = file.name;
        const extension = this.getExtension(file).toLowerCase();

        img.src = '/assets/images/svg/loading-placeholder-100.svg'
        if (allowedExtensions.includes(extension)) {
            const reader = new FileReader();
            reader.onload = function (e) {
                img.src = e.target.result;
            }

            reader.readAsDataURL(file);
            return true;
        }
        return false;

    }

}
