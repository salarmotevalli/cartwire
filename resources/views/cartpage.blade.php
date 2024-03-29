<div class="container mt-5">
    <div class="d-lg-flex p-3 bg-white justify-content-lg-between shadow rounded-4 text-start mb-5">
        <section class="p-2 rounded-4 card-body table-responsive mb-5 mb-lg-0">
            <table class="table table-striped" id="cart-table">
                <thead>
                    <tr>
                        <td></td>
                        @foreach ($columns as $name => $status)
                            <td>{{ $name }}</td>
                        @endforeach
                        <td>
                            {{ __('product price') }}
                        </td>
                        <td>
                            <span>{{ __('amount') }}</span> /
                            <span class="text-danger">{{ __('delete') }}</span>

                        </td>
                        <td>
                            {{ __('total price') }}
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr class="mb-3">
                            <td class="cart-table-row"></td>
                            @foreach ($columns as $name => $status)
                                @if ($status == $column_statuses['REQUIRED'])
                                    <td>{{ $item[$name] }}</td>
                                @elseif($status == $column_statuses['NULLABLE'])
                                    <td>{{ $item[$name] ?? '-' }}</td>
                                @endif
                            @endforeach

                            <td>{{ $item['price'] }}</td>

                            <livewire:change-amount :item_amount="$item['amount']" :item_id="$item['id']" :wire:key="$item['id']">

                            <td>{{ $item['total'] }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section class="p-3 bg-info rounded-4">
            <div class="text-white mb-4">
                <small class="text-secondary h5 text-md">{{ __('total') }}:</small>
                <div class="border-bottom"></div>
                <p class="text-white h3 ml-4 mt-1">$1000</p>
            </div>

            <div class="text-white mb-5">
                <small class="text-secondary h5 text-md">total:</small>
                <div class="border-bottom"></div>
                <p class="text-white h3 ml-4 mt-1">$2000</p>
            </div>

            <div class="text-white mb-5">
                <small class="text-secondary h5 text-md">total:</small>
                <div class="border-bottom"></div>
                <p class="text-white h3 ml-4 mt-1">$3000</p>
            </div>

            <div>
                </button>
            </div>
            <div>
                <button wire:click="clearCart" class="btn btn-secondary">
                    {{ __('clear') }}
                </button>
            </div>
        </section>

    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @include('cartwire::js.toastify')
    @include('cartwire::js.cartpage-js')
</div>
