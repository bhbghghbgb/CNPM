// Fade in elements when scrolling
document.addEventListener('DOMContentLoaded', function() {
    // Add fade-in class to all block-product sections
    const productBlocks = document.querySelectorAll('.block-product');
    
    // Add the fade-ready class to prepare for animations
    productBlocks.forEach(block => {
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
        productBlocks.forEach(block => {
            if (isInViewport(block) && block.classList.contains('fade-ready')) {
                block.classList.add('fade-in');
            }
        });
    }
    
    // Listen for scroll events
    window.addEventListener('scroll', handleScroll);
    
    // Trigger once on page load
    handleScroll();
});
