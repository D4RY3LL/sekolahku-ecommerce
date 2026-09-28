// resources/js/product-show.js

// Fungsi untuk mengganti gambar utama
window.changeMainImage = function(imageSrc) {
    document.getElementById('main-image').src = imageSrc;
};

// Fungsi untuk menambah ke wishlist
window.addToWishlist = function(productId) {
    fetch('/wishlist/add/' + productId, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(function(response) { 
        return response.json(); 
    })
    .then(function(data) {
        if (data.success) {
            alert('Produk ditambahkan ke wishlist');
            // Update badge wishlist
            const badge = document.querySelector('.header-icons .badge');
            if (badge) {
                badge.textContent = data.count;
            }
        } else {
            alert(data.message || 'Gagal menambah ke wishlist');
        }
    })
    .catch(function(error) {
        console.log('Error:', error);
        alert('Terjadi kesalahan');
    });
};

// Fungsi untuk share produk
window.shareProduct = function(name, description) {
    if (navigator.share) {
        navigator.share({
            title: name,
            text: description,
            url: window.location.href
        }).catch(function(error) {
            console.log('Share cancelled:', error);
        });
    } else {
        alert('Salin link: ' + window.location.href);
    }
};