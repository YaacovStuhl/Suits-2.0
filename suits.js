/*js for sticky nav - removed color change functionality*/
    // Navigation remains consistently styled - no color changes on scroll
    // js for blurry
    const loadText = document.querySelector('.loading-text')
    const bg = document.querySelector('.bg')
    
    // Only run blur effect if elements exist (home page only)
    if (loadText && bg) {
        let load = 0
        
        let int = setInterval(blurring, 20)
        
        function blurring() {
          load++
          
          if (load > 99) {
            clearInterval(int)
          }
          
          if (loadText) {
              loadText.innerText = `FLASH SALE! UP TO 60% OFF! `
              loadText.style.opacity = scale(load, 0, 100, 1, )
          }
          if (bg) {
              bg.style.filter = `blur(${scale(load, 0, 100, 30, 0)}px)`
          }
        }
    }
    
    // https://stackoverflow.com/questions/10756313/javascript-jquery-map-a-range-of-numbers-to-another-range-of-numbers
    const scale = (num, in_min, in_max, out_min, out_max) => {
      return ((num - in_min) * (out_max - out_min)) / (in_max - in_min) + out_min
    }
    
    // js for feedback - only initialize if elements exist
    const ratings = document.querySelectorAll('.rating')
    const ratingsContainer = document.querySelector('.ratings-container')
    const sendBtn = document.querySelector('#send')
    const panel = document.querySelector('#panel')
    
    // Only set up feedback system if all elements exist
    if (ratingsContainer && sendBtn && panel && ratings.length > 0) {
        let selectedRating = 'Satisfied'
        
        ratingsContainer.addEventListener('click', (e) => {
            if(e.target.parentNode.classList.contains('rating') && e.target.nextElementSibling) {
                removeActive()
                e.target.parentNode.classList.add('active')
                selectedRating = e.target.nextElementSibling.innerHTML
            } else if(
                e.target.parentNode.classList.contains('rating') &&
                e.target.previousSibling &&
                e.target.previousElementSibling.nodeName === 'IMG'
            ) {
                removeActive()
                e.target.parentNode.classList.add('active')
                selectedRating = e.target.innerHTML
            }
            
        })
        
        sendBtn.addEventListener('click', (e) => {
            panel.innerHTML = `
                <i class="fas fa-heart"></i>
                <strong>Thank You!</strong>
                <br>
                <strong>Feedback: ${selectedRating}</strong>
                <p>We'll use your feedback to improve our customer support</p>
            `
        })
        
        function removeActive() {
            for(let i = 0; i < ratings.length; i++) {
                ratings[i].classList.remove('active')
            }
        }
    }
    
    // Testimonials carousel
    let testimonialsInitialized = false
    let testimonialInterval = null
    
    function initTestimonials() {
        if (testimonialsInitialized) return
        
        const testimonialSlides = document.querySelectorAll('.testimonial-slide')
        const testimonialIndicators = document.querySelectorAll('.testimonial-indicator')
        
        if (testimonialSlides.length === 0 || testimonialIndicators.length === 0) {
            console.log('Testimonial elements not found')
            return
        }
        
        console.log('Initializing testimonials with', testimonialSlides.length, 'slides')
        
        let testimonialIdx = 0
        
        // Set initial slide - ensure only first is active
        testimonialSlides.forEach((slide, index) => {
            if (index === 0) {
                slide.classList.add('active')
            } else {
                slide.classList.remove('active')
            }
        })
        
        testimonialIndicators.forEach((indicator, index) => {
            if (index === 0) {
                indicator.classList.add('active')
            } else {
                indicator.classList.remove('active')
            }
        })
        
        function changeTestimonial() {
            // Ensure index is within bounds
            if (testimonialIdx >= testimonialSlides.length) {
                testimonialIdx = 0
            } else if (testimonialIdx < 0) {
                testimonialIdx = testimonialSlides.length - 1
            }
            
            // Hide all slides
            testimonialSlides.forEach(slide => {
                slide.classList.remove('active')
            })
            
            // Show current slide
            if (testimonialSlides[testimonialIdx]) {
                testimonialSlides[testimonialIdx].classList.add('active')
            }
            
            // Update testimonial indicators
            testimonialIndicators.forEach((indicator, index) => {
                if (index === testimonialIdx) {
                    indicator.classList.add('active')
                } else {
                    indicator.classList.remove('active')
                }
            })
        }
        
        function runTestimonials() {
            testimonialIdx = (testimonialIdx + 1) % testimonialSlides.length
            changeTestimonial()
        }
        
        // Clear any existing interval
        if (testimonialInterval) {
            clearInterval(testimonialInterval)
        }
        
        // Start interval
        testimonialInterval = setInterval(runTestimonials, 4000)
        
        // Add click handlers for testimonial indicators
        testimonialIndicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                if (testimonialInterval) {
                    clearInterval(testimonialInterval)
                }
                testimonialIdx = index
                changeTestimonial()
                testimonialInterval = setInterval(runTestimonials, 4000)
            })
        })
        
        testimonialsInitialized = true
        console.log('Testimonials initialized and started')
    }
    
    // Initialize testimonials when DOM is loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTestimonials)
    } else {
        initTestimonials()
    }