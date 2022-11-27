<div>
    <td>
        <input type="number" wire:change="update" value="{{ $item_amount }}" class="rounded" style="width: 80px;"
            min="1" wire:model="item_amount">
    </td>
    <td>
        <button wire:key="{{ $item_id }}" class="btn btn-danger" wire:click="deleteItem({{ $item_id }})">x
        </button>
    </td>
</div>
