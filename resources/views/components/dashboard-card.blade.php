<div class="col">
    <div class="card h-100 shadow-sm border-0 rounded-4">
        <div class="card-body d-flex">
            <div class="me-3">
                <i class="bi {{ $icon }} display-4 text-danger"></i>
            </div>
            <div class="flex-grow-1">
                <h5 class="card-title mb-2">{{ $title }}</h5>
                <p class="card-text small">{{ $description }}</p>
            </div>
        </div>
        <div class="card-footer bg-transparent border-0 text-end">
            <a href="{{ $link }}" class="btn btn-danger btn-sm rounded-pill">
                <i class="bi-box-arrow-in-right me-1"></i> Akses
            </a>
        </div>
    </div>
</div>
