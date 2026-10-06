@extends('catalogue.layouts.main')

@section('pagecss')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/catalogue/css/settings.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/catalogue/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/catalogue/css/navigation.css') }}">
@endsection

@section('content')
    <br />
    <section class="hero-banner mx-4">
        <div class="container-fluid px-4 px-lg-5">
            <div class="before-heading">Materials Control Department</div>
            <h1>IMF-MRS-PA (IMP) System</h1>

            <div class="hero-metrics">
                <div class="metric-card">
                    <small>Catalog</small>
                    <strong>{{ count($categories ?? []) }} categories</strong>
                </div>
                <div class="metric-card">
                    <small>Cart Items</small>
                    <strong><span class="hero-cart-total">{{ Setting::EcommerceCartTotalItems() }}</span> items</strong>
                </div>
                <div class="metric-card">
                    <small>Previous Requests</small>
                    <strong>{{ count($previously_ordered ?? []) }} history</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="content" class="py-4">
        <div class="container-fluid px-4 px-lg-5">
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

            <div class="catalogue-layout">
                <div class="catalogue-main">
                    <div class="catalogue-heading-row d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 pb-3 pt-4">
                        <h2 class="h3 fw-bold mb-0 text-dark">Product Catalogue</h2>

                        <div class="catalogue-heading-actions">
                            <form action="{{ route('catalogue.search') }}" method="POST" role="search" class="catalogue-search-form m-0">
                                @csrf
                                <div class="input-group search-input-group">
                                    <input
                                        type="text"
                                        name="query"
                                        class="form-control"
                                        placeholder="Search by name, description, or code..."
                                        aria-label="Search Products"
                                        style="border-top-left-radius: 16px; border-bottom-left-radius: 16px"
                                    >
                                    <button class="btn btn-search" type="submit" id="button-addon2">
                                        <i class="icon-search"></i>
                                    </button>
                                </div>
                            </form>

                            <details class="category-dropdown">
                                <summary>
                                    <i class="icon-grid"></i>
                                    <span>Browse by Category</span>
                                    <i class="icon-chevron-down category-dropdown-chevron"></i>
                                </summary>
                                <div class="category-dropdown-menu">
                                    @forelse($categories as $category)
                                        <a href="{{ route('catalogue.category_products', $category->id) }}">
                                            {{ ucwords(strtolower($category->description ?? $category->name ?? 'Category')) }}
                                        </a>
                                    @empty
                                        <span class="category-dropdown-empty">No categories found.</span>
                                    @endforelse
                                </div>
                            </details>
                        </div>
                    </div>

                    <div class="catalogue-tabs" role="tablist" aria-label="Catalogue item lists">
                        <button type="button" class="catalogue-tab is-active" id="previously-requested-tab" role="tab" aria-selected="true" aria-controls="previously-requested-panel" data-catalogue-tab="previously-requested-panel">
                                <i class="icon-history" aria-hidden="true"></i>
                            Previously Requested Items
                        </button>
                        <button type="button" class="catalogue-tab" id="newly-added-tab" role="tab" aria-selected="false" aria-controls="newly-added-panel" data-catalogue-tab="newly-added-panel" tabindex="-1">
                                <i class="icon-tag" aria-hidden="true"></i>
                            Newly Added Items
                        </button>
                    </div>

                    <div id="input-fields">

                        <div class="catalogue-tab-panel is-active" id="previously-requested-panel" role="tabpanel" aria-labelledby="previously-requested-tab">
                        <div class="section-shell">
                            <div class="section-header">
                                <h3>Previously Requested Items</h3>
                            </div>

                            <div class="previously-requested-wrap">
                                <table class="previously-requested-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 52%;">Product</th>
                                            <th style="width: 18%;">Code</th>
                                            <th style="width: 14%;">Qty</th>
                                            <th style="width: 16%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($previously_ordered as $po)
                                            <tr>
                                                <td data-label="Product">
                                                    <div class="previously-requested-name">
                                                        <small>
                                                            <a href="{{ route('product.front.show', $po->slug) }}">{{ $po->name }}</a>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td data-label="Code">
                                                    <span class="previously-requested-code">{{ $po->id }}</span>
                                                </td>
                                                <td data-label="Qty">
                                                    <input type="number" min="1" step="1" value="1" class="previously-requested-qty" id="quantity_prev_{{ $po->id }}" aria-label="Quantity for {{ $po->name }}">
                                                </td>
                                                <td data-label="Action">
                                                    <button type="button" class="previously-requested-action" onclick="add_to_cart('{{ $po->id }}');">
                                                        <i class="icon-shopping-cart"></i> Reorder
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="newly-added-empty">No previously requested items available.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        </div>

                        <div class="catalogue-tab-panel" id="newly-added-panel" role="tabpanel" aria-labelledby="newly-added-tab" hidden>
                        <div class="section-shell">
                            <div class="section-header">
                                <h3>Newly Added Items</h3>
                            </div>

                            <div class="newly-added-table-wrap">
                                <table class="newly-added-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 54%;">Product</th>
                                            <th style="width: 18%;">Code</th>
                                            <th style="width: 14%;">Qty</th>
                                            <th style="width: 14%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($newly_added as $po)
                                            <tr>
                                                <td data-label="Product">
                                                    <div class="newly-added-product">
                                                        <div class="product-copy">
                                                            <small>
                                                                <a href="{{ route('product.front.show', $po->slug) }}">{{ $po->name }}</a>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td data-label="Code">
                                                    <span class="newly-added-code">{{ $po->id }}</span>
                                                </td>
                                                <td data-label="Qty">
                                                    <input type="number" min="1" step="1" value="1" class="newly-added-qty" id="quantity{{ $po->id }}" aria-label="Quantity for {{ $po->name }}">
                                                </td>
                                                <td data-label="Action">
                                                    <button type="button" class="newly-added-action d-flex text-nowrap" onclick="add_to_cart('{{ $po->id }}');">
                                                        <i class="icon-shopping-cart"></i> Add to Cart
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="newly-added-empty">No newly added items available at the moment.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>

                    </div>
                </div>

                <aside class="catalogue-sidebar">
                    <div class="sidebar-card">
                        <div class="sidebar-header">
                            <h3>Cart Details</h3>
                            <span class="mini-badge">{{ Setting::EcommerceCartTotalItems() }}</span>
                        </div>

                        <div class="sidebar-items" id="my-cart-list">
                            @forelse(Setting::cart_items() as $item)
                                <div class="sidebar-item cart-item" data-cart-id="{{ $item->id }}">
                                    <div class="cart-item-icon" aria-label="Cart item icon">
                                        <i class="icon-bag"></i>
                                    </div>
                                    <div>
                                        <h4>{{ optional($item->product)->name }}</h4>
                                        <div class="cart-item-actions">
                                            <div class="side-cart-qty" aria-label="Quantity controls">
                                                <button type="button" class="qty-adjust qty-minus" data-cart-id="{{ $item->id }}" data-delta="-1" aria-label="Decrease quantity">−</button>
                                                <span class="qty-value">{{ $item->qty }}</span>
                                                <button type="button" class="qty-adjust qty-plus" data-cart-id="{{ $item->id }}" data-delta="1" aria-label="Increase quantity">+</button>
                                            </div>
                                            <button type="button" class="remove-cart-item" data-cart-id="{{ $item->id }}" aria-label="Remove item">
                                                <i class="icon-trash-alt1"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div>
                                        <strong>{{ optional($item->product)->discountedprice ? '₱' . number_format($item->product->discountedprice * $item->qty, 2) : '—' }}</strong>
                                    </div>
                                </div>
                            @empty
                                <div class="empty-sidebar">Your cart is currently empty.</div>
                            @endforelse
                        </div>

                        <div class="sidebar-total">
                            <span>Items</span>
                            <strong>{{ Setting::EcommerceCartTotalItems() }}</strong>
                        </div>

                        <div class="sidebar-actions">
                            <a href="{{ route('cart.front.checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
                            <!-- <a href="{{ route('cart.front.show') }}" class="btn btn-outline">View Cart</a> -->
                        </div>
                    </div>

                    <div class="sidebar-card">
                        <div class="sidebar-header">
                            <h3>Quick Info</h3>
                        </div>
                        <ul class="sidebar-note">
                            <li><i class="icon-check-circle"></i><span>Fast request processing with the existing MRS workflow.</span></li>
                            <li><i class="icon-check-circle"></i><span>Secure catalog browsing and order review before checkout.</span></li>
                            <li><i class="icon-check-circle"></i><span>Track quantities and stock availability before final submission.</span></li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection

@section('pagejs')
    <script src="{{ asset('theme/catalogue/js/functions.js') }}"></script>
    <script src="{{ asset('theme/catalogue/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('theme/catalogue/js/jquery.themepunch.revolution.min.js') }}"></script>

    <script>
        function formatCurrency(value) {
            return '₱' + Number(value || 0).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        function renderCartSidebar(items, totalItems) {
            const $container = $('#my-cart-list');
            const count = Number(totalItems || 0);

            if (!items || items.length === 0) {
                $container.html('<div class="empty-sidebar">Your cart is currently empty.</div>');
                $('.mini-badge').text(0);
                $('.top-cart-number').text(0);
                $('.hero-cart-total').text(0);
                $('.sidebar-total strong').text(0);
                return;
            }

            let html = '';

            $.each(items, function(index, item) {
                const image = item.photoPrimary || '{{ asset('images/no-image.png') }}';
                const price = Number(item.unitPrice || 0) * Number(item.qty || 0);
                html += '<div class="sidebar-item cart-item" data-cart-id="' + item.id + '">';
                html += '  <img src="' + image + '" alt="' + (item.name || 'Product') + '" onerror="this.src=\'{{ asset('images/no-image.png') }}\'" />';
                html += '  <div>';
                html += '    <h4>' + (item.name || '') + '</h4>';
                html += '    <div class="cart-item-actions">';
                html += '      <div class="side-cart-qty" aria-label="Quantity controls">';
                html += '        <button type="button" class="qty-adjust qty-minus" data-cart-id="' + item.id + '" data-delta="-1" aria-label="Decrease quantity">−</button>';
                html += '        <span class="qty-value">' + (item.qty || 0) + '</span>';
                html += '        <button type="button" class="qty-adjust qty-plus" data-cart-id="' + item.id + '" data-delta="1" aria-label="Increase quantity">+</button>';
                html += '      </div>';
                html += '      <button type="button" class="remove-cart-item" data-cart-id="' + item.id + '" aria-label="Remove item"><i class="icon-trash-alt1"></i></button>';
                html += '    </div>';
                html += '  </div>';
                html += '  <div>';
                html += '    <strong>' + formatCurrency(price) + '</strong>';
                html += '  </div>';
                html += '</div>';
            });

            $container.html(html);
            $('.mini-badge').text(count);
            $('.top-cart-number').text(count);
            $('.hero-cart-total').text(count);
            $('.sidebar-total strong').text(count);
            bindCartActions();
        }

        function bindCartActions() {
            $('.qty-adjust').off('click').on('click', function() {
                const cartId = $(this).data('cart-id');
                const delta = Number($(this).data('delta') || 0);
                const currentQty = Number($('.cart-item[data-cart-id="' + cartId + '"] .qty-value').text() || 0);
                const nextQty = currentQty + delta;

                if (nextQty <= 0) {
                    removeCartItem(cartId);
                    return;
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('cart.update') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        orderID: cartId,
                        quantity: nextQty
                    },
                    success: function(response) {
                        if (response && response.success !== false) {
                            renderCartSidebar(response.items, response.totalItems);
                            $.notify('Cart updated', { position: 'bottom right', className: 'success' });
                        }
                    }
                });
            });

            $('.remove-cart-item').off('click').on('click', function() {
                removeCartItem($(this).data('cart-id'));
            });
        }

        function removeCartItem(cartId) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('cart.remove_product') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    order_id: cartId
                },
                success: function(response) {
                    if (response && response.success !== false) {
                        renderCartSidebar(response.items, response.totalItems);
                        $.notify('Item removed from cart', { position: 'bottom right', className: 'success' });
                    }
                }
            });
        }

        $(document).ready(function() {
            var isAuthenticated = $('#isAuthenticated').val();
            bindCartActions();

            $('.catalogue-tab').on('click', function() {
                var $tab = $(this);
                var panelId = $tab.data('catalogue-tab');

                $('.catalogue-tab').removeClass('is-active').attr('aria-selected', 'false').attr('tabindex', '-1');
                $tab.addClass('is-active').attr('aria-selected', 'true').removeAttr('tabindex');
                $('.catalogue-tab-panel').attr('hidden', true).removeClass('is-active');
                $('#' + panelId).removeAttr('hidden').addClass('is-active');
            });

            $('.catalogue-tab').on('keydown', function(event) {
                if (event.key !== 'ArrowLeft' && event.key !== 'ArrowRight') {
                    return;
                }

                var $tabs = $('.catalogue-tab');
                var nextIndex = ($tabs.index(this) + (event.key === 'ArrowRight' ? 1 : $tabs.length - 1)) % $tabs.length;
                $tabs.eq(nextIndex).focus().trigger('click');
                event.preventDefault();
            });

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
                        $('.mini-badge').html(returnData['totalItems']);
                        $('.hero-cart-total').html(returnData['totalItems']);
                        if (returnData.items) {
                            renderCartSidebar(returnData.items, returnData.totalItems);
                        }
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