// slider-fix.js - Fixed implementation for slider functionality
document.addEventListener('DOMContentLoaded', function() {
    console.log('Slider fix script loaded');
    
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
    
    // Initialize the slider
    if (slides.length > 0) {
        console.log('Initializing slider with', slides.length, 'slides');
        goToSlide(0);
    }
});
