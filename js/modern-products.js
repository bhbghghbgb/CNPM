// Function to add product to cart
function addToCart(maSP) {
    // Use AJAX to add product to cart
    $.ajax({
        type: "POST",
        url: "./template/Ajax-GioHang/ThemGioHang.php",
        data: {
            MaSP: maSP,
            SoLuong: 1
        },
        success: function(response) {
            try {
                const result = JSON.parse(response);
                // Update cart item count
                updateCartCount(result);
                
                // Show success notification
                showNotification('Đã thêm sản phẩm vào giỏ hàng!', 'success');
            } catch (error) {
                console.error("Error parsing JSON response:", error);
                showNotification('Có lỗi xảy ra. Vui lòng thử lại!', 'error');
            }
        },
        error: function() {
            showNotification('Có lỗi xảy ra. Vui lòng thử lại!', 'error');
        }
    });
}

// Function to update cart count
function updateCartCount(data) {
    // Update the cart count display
    $('#quantity').text(data.SoLuong);
}

// Function to show notification
function showNotification(message, type = 'success') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="${type === 'success' ? 'ti-check-box' : 'ti-alert'}"></i>
            <span>${message}</span>
        </div>
    `;
    
    // Add to body
    document.body.appendChild(notification);
    
    // Show notification
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);
    
    // Hide after 3 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            notification.remove();
        }, 500);
    }, 3000);
}

// Initialize product favorite functionality
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners to favorites
    const favorites = document.querySelectorAll('.modern-product-favorite');
    favorites.forEach(favorite => {
        favorite.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            this.classList.toggle('active');
        });
    });
});
