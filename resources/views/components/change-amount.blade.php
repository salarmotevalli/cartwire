<td class="d-flex">

    <input type="number" wire:change="changeAmount" value="{{ $item_amount }}" class="rounded m-1" style="width: 80px;"
        min="1" wire:model="item_amount">

    <button wire:key="{{ $item_id }}" class="btn btn-danger" wire:click="deleteItem({{ $item_id }})">x
    </button>

</td>
