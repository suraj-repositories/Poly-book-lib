document.addEventListener('DOMContentLoaded', () => {
    (new Search()).init();
});

class Search {
    init() {
        this.enableSearchBarToggle(".SearchButton", "#SearchInput");
        this.enableSearching("#SearchInput");
    }

    enableSearchBarToggle(btnSelector, inputSelector) {
        const searchBtns = document.querySelectorAll(btnSelector);
        const searchInput = document.querySelector(inputSelector);
        const searchArea = document.querySelector("#SearchArea");
        const resultsContainer = document.querySelector("#SearchResults");

        searchBtns.forEach(searchBtn => {
            searchBtn.addEventListener("click", () => {
                searchInput.value = "";
                resultsContainer .innerHTML = "";
                searchArea.classList.remove("hide");
                document.body.style.overflow = "hidden";
                searchInput.focus();
            });
        });

        searchArea.addEventListener("click", (event) => {
            if (event.target === searchArea) {
                searchArea.classList.add("hide");
                document.body.style.overflow = "auto";
            }
        });
    }



    enableSearching(selector) {
        const searchInput = document.querySelector(selector);
        const searchArea = document.querySelector("#SearchArea");
        const resultsContainer = document.querySelector("#SearchResults");

        searchInput.addEventListener("keyup", (event) => {

            if (event.key === "Escape") {
                searchArea.classList.add('hide');
                return;
            }

            const query = searchInput.value.trim();
            if (query.length > 0) {
                this.search(query).then(data => {
                    this.displayResults(data.data, resultsContainer);
                }).catch(error => console.error("Search failed:", error));
            } else {
                resultsContainer.innerHTML = "";
            }
        });
    }

    async search(search) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        try {
            const response = await fetch(route("web.search"), {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "x-csrf-token": csrfToken,
                },
                body: JSON.stringify({ search }),
            });

            if (!response.ok) throw new Error("Network response was not ok");

            return await response.json();
        } catch (error) {
            console.error("Error:", error);
            throw error;
        }
    }

    displayResults(data, container) {
        container.innerHTML = "";
        if (data.length === 0) {
            container.innerHTML = "<div class='text-center justify-content-center'>No results found</div>";
            return;
        }

        container.innerHTML = data;
        this.enableHtmlToTextContent("[data-html-to-text='true']");
    }

    enableHtmlToTextContent(selector){
        const elements = document.querySelectorAll(selector);
        elements.forEach(element => {
            element.innerHTML = element.textContent;
        })
    }
}
