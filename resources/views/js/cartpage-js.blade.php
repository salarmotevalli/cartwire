<script>

    var rows = document.getElementsByClassName('cart-table-row');

    let counter = 1;
    for (let item of rows) {
        item.innerHTML = counter;
        counter++
    }
</script>
