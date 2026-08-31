@extends('catalogue.layouts.main')

@section('pagecss')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/catalogue/css/settings.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/catalogue/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/catalogue/css/navigation.css') }}">

    <style>
        :root {
            --brand-accent: #f6931d;
            --brand-light: #fff7ed;
            --brand-border: #ffedd5;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --bg-main: #f8fafc;
        }

        body {
            background-color: var(--bg-main) !important;
            color: var(--text-main);
        }

        .hero-banner {
            /* background: linear-gradient(135deg, #ffffff 0%, var(--brand-light) 100%); */
			background-color: #f6931d;
            border-bottom: 1px solid var(--brand-border);
            padding: 2rem 0;
        }

        .search-input-group {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .search-input-group .form-control {
            border: 1px solid #e2e8f0;
            border-right: none;
            padding: 0.75rem 1.25rem;
            font-size: 0.95rem;
        }

        .search-input-group .form-control:focus {
            box-shadow: none;
            border-color: #cbd5e1;
        }

        .btn-search {
            background-color: #f97316;
            color: #ffffff;
            border: none;
            padding: 0 1.5rem;
            transition: background-color 0.2s ease;
        }

        .btn-search:hover {
            background-color: #ea580c;
            color: #ffffff;
        }

        .section-header {
            display: flex;
            align-items: center;
            margin: 2.5rem 0 1.25rem 0;
        }

        .section-header h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-main);
            margin: 0;
            white-space: nowrap;
        }

        .section-header::after {
            content: "";
            flex-grow: 1;
            height: 1px;
            background-color: #e2e8f0;
            margin-left: 1rem;
        }

        .auth-banner {
            background-color: #fef2f2;
            border: 1px solid #fee2e2;
            border-radius: 0.5rem;
            color: #991b1b;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
        }

        a.disabled-link {
            pointer-events: none;
            cursor: default;
            opacity: 0.5;
        }

		/* cards styles */
		.owl-carousel .owl-item {
			border: 1px solid #80808040;
			border-radius: 10px;
			margin-bottom: 18px;
			box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
		}

		.category-card {
			border: 1px solid #80808040 !important;
			border-radius: 10px ;
			transition: transform 0.25s ease-in-out, box-shadow 0.25s ease-in-out;
		}

		.category-card:hover {
			transform: translateY(-4px);
			box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
		}

		.category-img {
			transition: transform 0.3s ease;
		}

		.category-card:hover .category-img {
			transform: scale(1.05);
		}

		/* Sharp Image Rendering & Ratio Containment */
		.product-img {
			object-fit: contain !important; /* Prevents stretching/distortion */
			image-rendering: -webkit-optimize-contrast; /* Sharpens pixel scaling on Chrome/Safari */
			image-rendering: crisp-edges;
			transition: transform 0.3s ease-in-out;
		}

		/* Card Hover Interactions */
		.product-card {
			transition: transform 0.25s ease, box-shadow 0.25s ease;
			border: 1px solid rgba(0, 0, 0, 0.08) !important;
		}

		.product-card:hover {
			transform: translateY(-4px);
			box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1) !important;
		}

		.product-card:hover .product-img {
			transform: scale(1.06);
		}

		/* Overlay Animation */
		.product-overlay {
			background: rgba(255, 255, 255, 0.85);
			backdrop-filter: blur(2px);
			transform: translateY(100%);
			transition: transform 0.25s ease-in-out;
		}

		.product-card:hover .product-overlay {
			transform: translateY(0);
		}

		/* Truncate long titles cleanly to 2 lines */
		.text-truncate-2 {
			display: -webkit-box;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
			overflow: hidden;
		}
    </style>
@endsection

@section('content')

    <!-- Top Banner -->
    <section class="hero-banner">
        <div class="container-fluid px-4 px-lg-5">
            <div class="before-heading font-secondary text-dark fw-semibold fs-12-f">Materials Control Department</div>
            <h1 class="text-dark fw-bold mb-0 fs-24 fs-lg-32">IMF-MRS-PA (IMP) System</h1>
        </div>
    </section>

    <!-- Main Content Area -->
    <section id="content" class="py-4">
        <div class="container-fluid px-4 px-lg-5">

            <!-- Authentication Warning Banner -->
            @if(!$isAuthenticated)
                <input type="hidden" id="isAuthenticated" value="false">
                <div class="auth-banner d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <i class="icon-lock me-2"></i>
                        <span><strong>Authentication Required:</strong> Access is limited to viewing only. Please sign in to request items.</span>
                    </div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{route('catalogue.home')}}" class="text-decoration-none">Catalogue</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Home</li>
                        </ol>
                    </nav>
                </div>
            @endif

            <!-- Single Line Header & Search Bar Bar -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 pb-3 pt-4">
                <h2 class="h3 fw-bold mb-0 text-dark">Product Catalogue</h2>
                
                <form action="{{ route('catalogue.search') }}" method="POST" role="search" class="m-0" style="min-width: 320px; max-width: 480px; width: 100%;">
                    @csrf
                    <div class="input-group search-input-group">
                        <input 
							type="text" 
							name="query" 
							class="form-control" 
							placeholder="Search by name, description, or code..." 
							aria-label="Search Products"
							style="border-top-left-radius: 10px; border-bottom-left-radius: 10px"
						>
                        <button class="btn btn-search" type="submit" id="button-addon2">
                            <i class="icon-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Dashboard Sections -->
            <div id="input-fields">
                
                <!-- Section: Previously Requested Items -->
                <div class="section-header">
                    <h3>Previously Requested Items</h3>
                </div>

                <div id="oc-products" class="owl-carousel products-carousel carousel-widget py-4" data-pagi="false" data-items-xs="1" data-items-sm="2" data-items-md="4" data-items-lg="6">
                    @forelse($previously_ordered as $po)
                        @php
                            $data = [
                                'code' => $po->id,
                                'inventory' => 100,
                                'name' => $po->name,
                                'image' => $po->PhotoSmall,
                                'slug' => $po->slug,
                                'id' => $po->id
                            ];
                        @endphp
                        <x-product-thumb :data="$data"/>
                    @empty
                    @endforelse
                </div>

                <!-- Section: Newly Added Items -->
                <div class="section-header">
                    <h3>Newly Added Items</h3>
                </div>

                <div id="oc-products-new" class="owl-carousel products-carousel carousel-widget" data-pagi="false" data-items-xs="1" data-items-sm="2" data-items-md="4" data-items-lg="6">
                    @forelse($newly_added as $po)
                        @php
                            $data = [
                                'code' => $po->id,
                                'inventory' => 100,
                                'name' => $po->name,
                                'image' => $po->PhotoSmall,
                                'slug' => $po->slug,
                                'id' => $po->id
                            ];
                        @endphp
                        <x-product-thumb :data="$data"/>
                    @empty
                    @endforelse
                </div>

                <!-- Section: Categories -->
                <div class="section-header">
                    <h3>Browse by Category</h3>
                </div>

                <div id="portfolio" class="row g-3 g-lg-4">
					@forelse($categories as $c)
						<x-category-thumb :c="$c"/>
					@empty
						<div class="col-12 text-center py-5 text-muted">
							<p class="mb-0">No categories found.</p>
						</div>
					@endforelse
				</div>
            </div>
        </div>
    </section>

@endsection

@section('pagejs')
    <script src="{{ asset('theme/catalogue/js/functions.js') }}"></script>
    <script src="{{ asset('theme/catalogue/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('theme/catalogue/js/jquery.themepunch.revolution.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var isAuthenticated = $('#isAuthenticated').val();
            
            if (isAuthenticated === 'false') {
                $('.grid-inner a, #top-cart a, .product-image a').click(function(e) {
                    e.preventDefault();
                }).addClass('disabled-link');

                $("#input-fields :input").prop("disabled", true);
            }
        });

        function add_to_cart(product) {
            const qty = $('#quantity' + product).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                data: {
                    "product_id": product,
                    "qty": qty,
                    "_token": "{{ csrf_token() }}",
                },
                type: "post",
                url: "{{route('product.add-to-cart')}}",
                success: function(returnData) {
                    $("#loading-overlay").hide();
                    if (returnData['success']) {
                        $('.top-cart-number').html(returnData['totalItems']);
                        $.notify("Product Added to your cart", {
                            position: "bottom right",
                            className: "success"
                        });
                    } else {
                        $.notify("Reached maximum limit number of items.", {
                            position: "bottom right",
                            className: "error"
                        });
                    }
                }
            });
        }
    </script>
@endsection