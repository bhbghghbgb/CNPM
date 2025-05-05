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

// ===== BUTTON EFFECTS (Merged from button-effects.js) =====

document.addEventListener('DOMContentLoaded', function() {
    // Hiệu ứng phản hồi khi click nút
    const productButtons = document.querySelectorAll('.modern-product-button');
    
    productButtons.forEach(button => {
        button.addEventListener('mousedown', function() {
            this.style.transform = 'scale(0.95)';
        });
        
        button.addEventListener('mouseup', function() {
            this.style.transform = '';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });

    // Tạo phần tử thông báo thêm vào giỏ hàng (nếu chưa có)
    let notificationElement = document.querySelector('.cart-notification');
    if (!notificationElement) {
        notificationElement = document.createElement('div');
        notificationElement.className = 'cart-notification';
        notificationElement.innerHTML = '<i class="ti-shopping-cart"></i> <span>Sản phẩm đã được thêm vào giỏ</span>';
        document.body.appendChild(notificationElement);
    }

    // Thêm hiệu ứng phản hồi giỏ hàng thành công (chỉ gắn listener một lần)
    // Sử dụng event delegation để xử lý các nút được thêm sau này (nếu có)
    document.body.addEventListener('click', function(event) {
        if (event.target.matches('.btn-add-to-cart')) {
            const button = event.target;
            const originalText = button.innerHTML;
            const productCard = button.closest('.modern-product-card');
            const quantityBadge = document.querySelector('#quantity');
            
            if (productCard && !button.classList.contains('btn-add-success')) { // Tránh click liên tục
                // Thêm hiệu ứng phản hồi xác nhận
                button.disabled = true; // Vô hiệu hóa tạm thời
                setTimeout(() => {
                    button.innerHTML = '<i class="ti-check"></i> Đã thêm';
                    button.classList.add('btn-add-success');
                    
                    // Hiển thị thông báo
                    if (notificationElement) {
                        notificationElement.classList.add('show');
                    }
                    
                    // Animation cho badge số lượng
                    if (quantityBadge) {
                        quantityBadge.classList.add('cart-item-added');
                    }
                    
                    setTimeout(() => {
                        button.innerHTML = originalText;
                        button.classList.remove('btn-add-success');
                        if (notificationElement) {
                            notificationElement.classList.remove('show');
                        }
                        if (quantityBadge) {
                            quantityBadge.classList.remove('cart-item-added');
                        }
                        button.disabled = false; // Kích hoạt lại nút
                    }, 1500);
                }, 300); // Thời gian chờ nhỏ trước khi hiển thị trạng thái thành công
            }
        }
    });
});
