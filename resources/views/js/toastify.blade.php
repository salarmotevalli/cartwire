<script>

    window.addEventListener('item_deleted', event => {

        Toastify({
            text: event.detail.message,
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "bottom", // `top` or `bottom`
            position: "left", // `left`, `center` or `right`
            className: "info",
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                borderRadius: '0.8rem',
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            },
            onClick: function(){} // Callback after click
        }).showToast();

    });

</script>
