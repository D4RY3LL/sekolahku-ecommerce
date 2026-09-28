// Cart page JavaScript
$(document).ready(function() {
    // Update quantity
    $('.quantity-input').on('change', function() {
        let cartId = $(this).data('cart-id');
        let quantity = $(this).val();
        let price = $(this).data('price');
        
        $.ajax({
            url: '/cart/update/' + cartId,
            method: 'PUT',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                quantity: quantity
            },
            success: function(response) {
                if (response.success) {
                    $('#subtotal-' + cartId).text(response.subtotal);
                    $('#cart-total').text(response.total);
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let error = xhr.responseJSON;
                    alert(error.error + '. Maksimal ' + error.max_stock);
                    location.reload();
                }
            }
        });
    });

    // Remove item
    $('.remove-item').on('click', function() {
        if (!confirm('Hapus item dari keranjang?')) return;
        
        let cartId = $(this).data('cart-id');
        
        $.ajax({
            url: '/cart/remove/' + cartId,
            method: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function() {
                $('#cart-item-' + cartId).fadeOut(function() {
                    $(this).remove();
                    if ($('.cart-item').length === 0) {
                        location.reload();
                    }
                });
            }
        });
    });
});