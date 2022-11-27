<div class="container mt-5">
    <div class="d-lg-flex p-3 bg-white justify-content-lg-between shadow rounded-4 text-start mb-5">
        <section class="p-2 rounded-4 card-body table-responsive mb-5 mb-lg-0">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        @foreach ($columns as $column)
                            <td>{{ $column }}</td>
                        @endforeach
                        <td>amount</td>
                        <td class="text-danger">delete</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr class="mb-3">
                            @foreach ($columns as $column)
                                <td>{{ $item[$column] }}</td>
                            @endforeach
                            @livewire('update-amount', ['item_amount' => $item['amount'], 'item_id' => $item['id']], key('item-' . $item['id']))
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section class="p-3 bg-info rounded-4">
            <div class="text-white mb-4">
                <small class="text-secondary h5 text-md">total:</small>
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
                <button class="btn btn-secondary">
                    pay order
                </button>
            </div>
            <div>
                <button wire:click="clearCart" class="btn btn-secondary">
                    clear
                </button>
            </div>
        </section>

    </div>
</div>
