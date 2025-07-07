document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    
    // Form submission handling
    const contactForm = document.querySelector('.contact-form form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Thank you for your message! We will get back to you soon.');
            this.reset();
        });
    }
    
    // Service details page functionality
    if (document.querySelector('.service-details')) {
        // Get the service parameter from URL
        const urlParams = new URLSearchParams(window.location.search);
        const service = urlParams.get('service');
        
        // Hide all service content divs
        document.querySelectorAll('.service-content').forEach(div => {
            div.style.display = 'none';
        });
        
        // Show the selected service content
        if (service && document.getElementById(`${service}-content`)) {
            document.getElementById(`${service}-content`).style.display = 'block';
        } else {
            // Default to first service if none specified
            document.querySelector('.service-content').style.display = 'block';
        }
    }
});