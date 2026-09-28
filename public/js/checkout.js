// Checkout page JavaScript
$(document).ready(function() {
    var shippingCost = 0;
    var subtotal = window.subtotal || 0;

    $('#shipping_courier').on('change', function() {
        var courier = $(this).val();
        if (courier) {
            // Simulasi hitung ongkir
            var costs = {
                'jne': {'reguler': 15000, 'express': 25000},
                'tiki': {'reguler': 14000, 'express': 23000},
                'pos': {'reguler': 13000, 'express': 22000},
                'sicepat': {'reguler': 16000, 'express': 27000, 'same day': 35000}
            };

            var services = $('#shipping_service');
            services.empty().append('<option value="">Pilih Layanan</option>');
            
            for (var service in costs[courier]) {
                if (costs[courier].hasOwnProperty(service)) {
                    var cost = costs[courier][service];
                    services.append('<option value="' + service + '" data-cost="' + cost + '">' + 
                                   service.toUpperCase() + ' - Rp ' + cost.toLocaleString('id-ID') + 
                                   '</option>');
                }
            }
            
            services.prop('disabled', false);
        } else {
            $('#shipping_service').prop('disabled', true).empty();
        }
    });

    $('#shipping_service').on('change', function() {
        var selected = $(this).find(':selected');
        shippingCost = selected.data('cost') || 0;
        
        $('#shipping_cost').val(shippingCost);
        $('#display-shipping-cost').text('Rp ' + shippingCost.toLocaleString('id-ID'));
        
        var grandTotal = subtotal + shippingCost;
        $('#grand-total').text('Rp ' + grandTotal.toLocaleString('id-ID'));
    });
});