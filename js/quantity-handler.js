// js/quantity-handler.js
function initQuantityHandlers() {
    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.closest('.quantity-control').querySelector('.quantity-input');
            let value = parseInt(input.value);
            const min = parseInt(input.min);
            const max = parseInt(input.max);
            
            if (this.classList.contains('minus')) {
                value = Math.max(value - 1, min);
            } else {
                value = Math.min(value + 1, max);
            }
            
            input.value = value;
            
            // Kích hoạt sự kiện change
            input.dispatchEvent(new Event('change'));
        });
    });
}

// Ngăn xóa hoàn toàn giá trị
function preventDelete(e, input) {
    // Nếu giá trị hiện tại là 1 và nhấn phím xóa/backspace
    if ((e.key === 'Delete' || e.key === 'Backspace') && input.value === '1') {
        return false;
    }
    return true;
}

// Validate và tự động điều chỉnh
function validateQuantity(input) {
    if (input.value === '' || isNaN(input.value)) {
        input.value = input.min;
        return;
    }
    
    let value = parseInt(input.value);
    if (value < parseInt(input.min)) input.value = input.min;
    if (value > parseInt(input.max)) input.value = input.max;
}

// Bắt sự kiện blur (khi rời khỏi ô input)
document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('blur', function() {
        if (!this.value || isNaN(this.value)) {
            this.value = this.min;
        }
    });
});

// Chạy khi DOM sẵn sàng
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM đã sẵn sàng');
    initQuantityHandlers();
});

// Nếu có AJAX load lại nội dung
initQuantityHandlers();