/*js for sticky nav - removed color change functionality*/
    // Navigation remains consistently styled - no color changes on scroll
    // js for blurry
    const loadText = document.querySelector('.loading-text')
    const bg = document.querySelector('.bg')
    
    let load = 0
    
    let int = setInterval(blurring, 20)
    
    function blurring() {
      load++
    
      if (load > 99) {
        clearInterval(int)
      }
    
      loadText.innerText = `FLASH SALE! UP TO 60% OFF! `
      loadText.style.opacity = scale(load, 0, 100, 1, )
      bg.style.filter = `blur(${scale(load, 0, 100, 30, 0)}px)`
    }
    
    // https://stackoverflow.com/questions/10756313/javascript-jquery-map-a-range-of-numbers-to-another-range-of-numbers
    const scale = (num, in_min, in_max, out_min, out_max) => {
      return ((num - in_min) * (out_max - out_min)) / (in_max - in_min) + out_min
    }
    
    // js for feedback
    const ratings = document.querySelectorAll('.rating')
    const ratingsContainer = document.querySelector('.ratings-container')
    const sendBtn = document.querySelector('#send')
    const panel = document.querySelector('#panel')
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
    
    
    // js for rotating images with indicators
    let carouselInitialized = false
    
    function initCarousel() {
        if (carouselInitialized) return
        
        const imgs = document.getElementById('imgs')
        const indicators = document.querySelectorAll('.indicator')
        const img = document.querySelectorAll('#imgs img')
        
        if (!imgs || img.length === 0) {
            console.log('Carousel elements not found')
            return
        }
        
        console.log('Initializing carousel with', img.length, 'images')
        
        let idx = 0
        
        // Set initial position
        imgs.style.transform = 'translateX(0%)'
        
        // Set up indicators
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === 0)
        })
        
        function changeImage() {
            if(idx >= img.length) {
                idx = 0
            } else if(idx < 0) {
                idx = img.length - 1
            }
        
            console.log('Changing to image:', idx, 'Transform:', `translateX(${-idx * 100}%)`)
            imgs.style.transform = `translateX(${-idx * 100}%)`
            
            // Update indicators
            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('active', index === idx)
            })
        }
        
        function run() {
            idx++
            changeImage()
        }
        
        // Start interval
        let interval = setInterval(run, 3000)
        
        // Add click handlers for indicators
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                clearInterval(interval)
                idx = index
                changeImage()
                interval = setInterval(run, 3000)
            })
        })
        
        carouselInitialized = true
        console.log('Carousel initialized and started')
    }
    
    // Initialize when DOM is loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCarousel)
    } else {
        initCarousel()
    }
    
    // Testimonials carousel
    let testimonialsInitialized = false
    
    function initTestimonials() {
        if (testimonialsInitialized) return
        
        const testimonialSlides = document.querySelectorAll('.testimonial-slide')
        const testimonialIndicators = document.querySelectorAll('.testimonial-indicator')
        
        if (testimonialSlides.length === 0) {
            console.log('Testimonial elements not found')
            return
        }
        
        console.log('Initializing testimonials with', testimonialSlides.length, 'slides')
        
        let testimonialIdx = 0
        
        // Set initial slide
        testimonialSlides.forEach((slide, index) => {
            slide.classList.toggle('active', index === 0)
        })
        
        testimonialIndicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === 0)
        })
        
        function changeTestimonial() {
            if(testimonialIdx >= testimonialSlides.length) {
                testimonialIdx = 0
            } else if(testimonialIdx < 0) {
                testimonialIdx = testimonialSlides.length - 1
            }
            
            console.log('Changing to testimonial:', testimonialIdx)
            
            // Hide all slides
            testimonialSlides.forEach(slide => slide.classList.remove('active'))
            
            // Show current slide
            testimonialSlides[testimonialIdx].classList.add('active')
            
            // Update testimonial indicators
            testimonialIndicators.forEach((indicator, index) => {
                indicator.classList.toggle('active', index === testimonialIdx)
            })
        }
        
        function runTestimonials() {
            testimonialIdx++
            changeTestimonial()
        }
        
        // Start interval
        let testimonialInterval = setInterval(runTestimonials, 4000)
        
        // Add click handlers for testimonial indicators
        testimonialIndicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                clearInterval(testimonialInterval)
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