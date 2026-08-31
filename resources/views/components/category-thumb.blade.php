<div class="col-6 col-md-4 col-lg-3">
    <div class="card h-100 border-0 shadow-sm category-card overflow-hidden">
        <a href="{{ route('catalogue.category_products', $c->id) }}" class="text-decoration-none text-dark d-flex flex-column h-100">
            {{-- Image Wrapper with Aspect Ratio --}}
            <div class="ratio ratio-4x3 bg-light overflow-hidden position-relative">
                <img src="{{ asset($c->Photo) }}" 
                     alt="{{ $c->name }}" 
                     class="object-fit-cover w-100 h-100 category-img" 
                     onerror="this.src='{{ asset('img/category.png') }}'" 
                     loading="lazy">
            </div>

            {{-- Card Body --}}
            <div class="card-body d-flex flex-column justify-content-between text-center p-3">
                <h3 class="h5 font-weight-bold text-truncate mb-2" title="{{ $c->description }}">
                    {{ ucwords(strtolower($c->description)) }}
                </h3>
                
                <span class="btn btn-sm btn-outline-warning mt-auto align-self-center px-3 rounded-pill">
                    View All
                </span>
            </div>
        </a>
    </div>
</div>