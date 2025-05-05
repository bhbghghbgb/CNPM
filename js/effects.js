/**
 * Effects.js
 * File JavaScript tổng hợp các hiệu ứng cho trang web
 * 
 * Được tạo bằng cách hợp nhất các file:
 * - header-effects.js
 * - scroll-effects.js
 * - slider-fix.js
 */

// DOM Content Loaded Event
document.addEventListener('DOMContentLoaded', function() {
    console.log('Effects script loaded');
    
    // ========== HEADER EFFECTS ==========
    
    // Hiệu ứng cho header
    initHeaderEffects();
    
    // ========== SCROLL EFFECTS ==========
    
    // Hiệu ứng fade-in và scroll
    initScrollEffects();
    
    // Nút Back to Top
    initBackToTop();
    
    // ========== SLIDER EFFECTS ==========
    
    // Khởi tạo slider nếu có
    initSlider();
});

// ===== HEADER EFFECTS FUNCTIONS =====

/**
 * Khởi tạo hiệu ứng cho header
 */
function initHeaderEffects() {
    const header = document.getElementById('header');
    const messageElement = document.getElementById('message');
    
    // Kiểm tra xem header có tồn tại không
    if (header) {
        // Thêm hiệu ứng scroll cho header
        window.addEventListener('scroll', function() {
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }
    
    // Hàm hiển thị thông báo
    window.addmessText = function(text, type = 'info') {
        if (messageElement) {
            messageElement.innerHTML = text;
            
            // Xóa các class cũ
            messageElement.classList.remove('success', 'error', 'warning', 'info');
            
            // Thêm class mới dựa trên type
            messageElement.classList.add(type);
            
            // Hiển thị thông báo
            messageElement.style.opacity = "1";
            messageElement.style.transform = "translateY(0)";
            
            // Ẩn thông báo sau 4 giây
            setTimeout(function() {
                messageElement.style.opacity = "0";
                messageElement.style.transform = "translateY(-20px)";
            }, 4000);
        }
    };
    
    // Cập nhật hiệu ứng search-box
    initSearchBox();
}

/**
 * Khởi tạo hiệu ứng cho ô tìm kiếm
 */
function initSearchBox() {
    const searchBox = document.getElementById('search-box');
    const searchBtn = document.getElementById('btn-search');
    const searchInput = document.getElementById('find');
    
    if (searchBox && searchBtn && searchInput) {
        // Hiệu ứng khi hover vào nút search
        searchBox.addEventListener('mouseenter', function() {
            searchBox.classList.add('active');
            searchInput.style.width = '250px';
            searchInput.style.padding = '10px 15px';
            searchInput.style.transform = 'translateX(-100%)';
            searchInput.focus();
        });
        
        // Hiệu ứng khi hover ra ngoài ô search và không có nội dung
        searchBox.addEventListener('mouseleave', function() {
            if (!searchInput.value.trim()) {
                searchBox.classList.remove('active');
                searchInput.style.width = '0';
                searchInput.style.padding = '0';
            }
        });
        
        // Sự kiện khi click vào nút search
        searchBtn.addEventListener('click', function(e) {
            if (searchInput.value.trim()) {
                // Nếu có nội dung thì submit form hoặc chuyển hướng
                window.location = "./danhsach.php?Find=" + encodeURIComponent(searchInput.value.trim());
            } else {
                // Nếu không có nội dung thì toggle trạng thái
                searchBox.classList.toggle('active');
                if (searchBox.classList.contains('active')) {
                    searchInput.style.width = '250px';
                    searchInput.style.padding = '10px 15px';
                    searchInput.style.transform = 'translateX(-100%)';
                    searchInput.focus();
                } else {
                    searchInput.style.width = '0';
                    searchInput.style.padding = '0';
                }
            }
        });
        
        // Sự kiện khi nhấn Enter trong ô tìm kiếm
        searchInput.addEventListener('keydown', function(e) {
            if (e.keyCode === 13 && searchInput.value.trim()) {
                window.location = "./danhsach.php?Find=" + encodeURIComponent(searchInput.value.trim());
            }
        });
    }
}

// ===== SCROLL EFFECTS FUNCTIONS =====

/**
 * Khởi tạo hiệu ứng scroll
 */
function initScrollEffects() {
    console.log('Scroll effects loaded');
    
    // Chờ một chút để trang hoàn thành việc render
    setTimeout(function() {
        // Hiệu ứng cuộn cho trang chủ
        const fadeElements = document.querySelectorAll('.fade-in');
        const productBlocks = document.querySelectorAll('.block-product');
        
        console.log('Found elements:', {
            fadeElements: fadeElements.length,
            productBlocks: productBlocks.length,
        });
        
        // Chuẩn bị hiệu ứng cho các block sản phẩm nhưng đặt opacity về 1 trước
        productBlocks.forEach(block => {
            block.style.opacity = '1'; // Đảm bảo luôn hiển thị kể cả khi JS có vấn đề
            block.classList.add('fade-ready');
        });
        
        // Function to check if an element is in viewport
        function isInViewport(element) {
            const rect = element.getBoundingClientRect();
            return (
                rect.top <= (window.innerHeight || document.documentElement.clientHeight) * 0.75
            );
        }
        
        // Function to handle scroll event
        function handleScroll() {
            // Xử lý sản phẩm
            productBlocks.forEach(block => {
                if (isInViewport(block) && block.classList.contains('fade-ready')) {
                    block.classList.add('fade-in-active');
                }
            });
            
            // Xử lý các phần tử có class fade-in
            fadeElements.forEach(element => {
                if (isInViewport(element)) {
                    element.classList.add('visible');
                }
            });
        }
        
        // Listen for scroll events
        window.addEventListener('scroll', handleScroll);
        
        // Trigger once on page load
        handleScroll();
    }, 300);
}

/**
 * Khởi tạo nút Back to Top
 */
function initBackToTop() {
    // Tạo nút Back to Top nếu chưa có
    const existingBtn = document.querySelector('.back-to-top');
    
    if (!existingBtn) {
        const backToTopBtn = document.createElement('button');
        backToTopBtn.innerHTML = '<i class="ti-arrow-up"></i>';
        backToTopBtn.className = 'back-to-top';
        document.body.appendChild(backToTopBtn);
        
        // Hiển thị/ẩn nút khi cuộn
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        });
        
        // Xử lý khi click nút quay lại đầu trang
        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
}

// ===== SLIDER FUNCTIONS =====

/**
 * Khởi tạo slider
 */
function initSlider() {
    console.log('Slider init');
    
    // Ensure the slider container exists before trying to initialize
    if (!document.querySelector('.modern-slider-container')) {
        console.warn('Slider container not found');
        return;
    }
    
    // Get all the necessary elements
    const slides = document.querySelectorAll('.modern-slider-container .slide');
    const prevButton = document.querySelector('.modern-slider-container .prev-button');
    const nextButton = document.querySelector('.modern-slider-container .next-button');
    const indicators = document.querySelectorAll('.modern-slider-container .indicator');
    const counter = document.querySelector('.modern-slider-container .slider-counter');
    
    console.log('Found elements:', {
        slides: slides.length,
        prevButton: prevButton ? 'yes' : 'no',
        nextButton: nextButton ? 'yes' : 'no',
        indicators: indicators.length,
        counter: counter ? 'yes' : 'no'
    });
    
    let currentSlide = 0;
    let slideInterval;
    
    // Function to go to a specific slide
    function goToSlide(index) {
        console.log('Going to slide:', index);
        
        // Remove active class from all slides and indicators
        slides.forEach(slide => slide.classList.remove('active'));
        indicators.forEach(indicator => indicator.classList.remove('active'));
        
        // Update current slide index
        currentSlide = index;
        
        // Add active class to current slide and indicator
        slides[currentSlide].classList.add('active');
        indicators[currentSlide].classList.add('active');
        
        // Update counter
        if (counter) {
            counter.textContent = `${currentSlide + 1}/${slides.length}`;
        }
        
        // Restart autoplay
        startSlideInterval();
    }
    
    // Function to go to the next slide
    function nextSlide() {
        console.log('Next slide clicked');
        const nextIndex = currentSlide + 1 >= slides.length ? 0 : currentSlide + 1;
        goToSlide(nextIndex);
    }
    
    // Function to go to the previous slide
    function prevSlide() {
        console.log('Previous slide clicked');
        const prevIndex = currentSlide - 1 < 0 ? slides.length - 1 : currentSlide - 1;
        goToSlide(prevIndex);
    }
    
    // Function to start auto-sliding
    function startSlideInterval() {
        clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
    }
    
    // Add event listeners to buttons
    if (prevButton) {
        prevButton.addEventListener('click', function(e) {
            e.preventDefault();
            prevSlide();
        });
    }
    
    if (nextButton) {
        nextButton.addEventListener('click', function(e) {
            e.preventDefault();
            nextSlide();
        });
    }
    
    // Add event listeners to indicators
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Indicator clicked:', index);
            goToSlide(index);
        });
    });
    
    // Pause autoplay on hover
    const sliderContainer = document.querySelector('.modern-slider-container');
    if (sliderContainer) {
        sliderContainer.addEventListener('mouseenter', () => {
            clearInterval(slideInterval);
        });
        
        sliderContainer.addEventListener('mouseleave', () => {
            startSlideInterval();
        });
    }
    
    // Start autoplay
    startSlideInterval();
    
    // Initialize the first slide
    goToSlide(0);
}
