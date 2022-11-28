<td class="d">

    <input type="number" class="rounded m-1" style="width: 80px;" min="1" wire:model.debounce.500ms="item_amount">

    <button wire:key="{{ $item_id }}" class="btn btn-danger" wire:click="deleteItem">x
    </button>

</td>
