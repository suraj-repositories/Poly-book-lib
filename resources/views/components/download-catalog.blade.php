<div class="service-box">
    <h4>Download Catalog</h4>
    <div class="download-catalog">
        <a href="#" class="d-flex">
            <i class="bi bi-box-arrow-down"></i>
            <span>Downloads</span>
            <span class="ms-auto fw-bold">{{ count($downloads ?? []) }}<sup>*</sup></span>
        </a>
        <a href="#">
            <i class="bi bi-filetype-pdf"></i>
            <span>Books</span>
            <span class="ms-auto fw-bold">{{ count($books ?? []) }}<sup>*</sup> </span>
        </a>
    </div>
</div>
