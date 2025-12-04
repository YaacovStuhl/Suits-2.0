<?php
// Set page title
$page_title = "Home";
?>

<?php include 'header.php'; ?>

<!-- Hero Section with Blur Effect -->
<div class="blurry" id="blurry">
    <section class="bg"></section>
    <div class="loading-text"></div>
</div>

<!-- ResponsiveSlides Section -->
<div class="hero-section">
    <div class="hero-container">
        <!-- ResponsiveSlides Section -->
        <div class="carousel-section">
            <ul class="rslides">
                <li><img src="images/purple.jpg" alt="Purple Suit"></li>
                <li><img src="images/zoot.jpg" alt="Zoot Suit"></li>
                <li><img src="images/x-mas.jpg" alt="Christmas Suit"></li>
                <li><img src="images/stripes.jpg" alt="Striped Suit"></li>
            </ul>
        </div>
        
        <!-- Testimonials Section -->
        <div class="testimonials-section">
            <div class="testimonials-wrapper">
                <div class="testimonials-header">
                    <h2>What Industry Leaders Say</h2>
                    <p>Trusted by fashion experts worldwide</p>
                </div>
                
                <div class="testimonials-carousel">
                    <div class="testimonial-slide active">
                        <div class="testimonial-content">
                            <p class="testimonial-text">A happy hybrid of price and quality, you'll never get a suit anywhere else</p>
                            <div class="testimonial-author">
                                <h4>GQ Magazine</h4>
                                <span>Fashion Authority</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="testimonial-slide">
                        <div class="testimonial-content">
                            <p class="testimonial-text">Simply Suits are simply amazing. Trademark that!</p>
                            <div class="testimonial-author">
                                <h4>Howard Stern</h4>
                                <span>Media Personality</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="testimonial-slide">
                        <div class="testimonial-content">
                            <p class="testimonial-text">Some of the best suits I've ever seen, and I know fashion!</p>
                            <div class="testimonial-author">
                                <h4>Jay Leno</h4>
                                <span>Television Host</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="testimonial-slide">
                        <div class="testimonial-content">
                            <p class="testimonial-text">Simply Suits may even have made up for the 70s</p>
                            <div class="testimonial-author">
                                <h4>Time Magazine</h4>
                                <span>International Publication</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial Indicators -->
                <div class="testimonial-indicators">
                    <span class="testimonial-indicator active" data-testimonial="0"></span>
                    <span class="testimonial-indicator" data-testimonial="1"></span>
                    <span class="testimonial-indicator" data-testimonial="2"></span>
                    <span class="testimonial-indicator" data-testimonial="3"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CEO Message Section -->
<div class="ceo-section">
    <div class="ceo-container">
        <div class="ceo-header">
            <h1>Leadership Message</h1>
            <p class="ceo-subtitle">A word from our Chief Executive Officer</p>
        </div>
        
        <div class="ceo-content">
            <div class="ceo-image">
                <div class="ceo-image-wrapper">
                    <img src="images/self.jpg" alt="Yaacov Stuhl, CEO of Simply Suits">
                    <div class="ceo-badge">
                        <span class="badge-title">CEO</span>
                        <span class="badge-company">Simply Suits</span>
                    </div>
                </div>
            </div>
            
            <div class="ceo-message">
                <div class="message-content">
                    <h2>Excellence in Every Stitch</h2>
                    <p class="message-text">
                        At Simply Suits, we believe that exceptional style begins with exceptional craftsmanship. 
                        Our commitment to quality is unwavering—every suit is meticulously crafted with precision 
                        and attention to detail that reflects our passion for excellence.
                    </p>
                    <p class="message-text">
                        We understand that a great suit is more than just fabric and thread; it's confidence, 
                        professionalism, and personal expression. Our global team of master designers and artisans 
                        work tirelessly to bring you the finest in contemporary menswear, combining timeless 
                        elegance with modern innovation.
                    </p>
                    <p class="message-text">
                        What truly makes a suit exceptional is the person wearing it. We invite you to discover 
                        the perfect fit that reflects your unique style and helps you make your best impression 
                        in every moment that matters.
                    </p>
                </div>
                
                <div class="ceo-signature">
                    <div class="signature-line"></div>
                    <div class="signature-details">
                        <h3>Yaacov Stuhl</h3>
                        <p>Chief Executive Officer</p>
                        <p>Simply Suits</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Collections Section -->
<h1 id="catalog">Our Collections</h1>

<div class="formal">
    <div><img src="images/formal.jpg" alt="Formal Suits"></div>
    <div class="hey"><a href="#"><h1>Formal Suits</h1>
    Be it a wedding, or dressing to the nines, you'll find the perfect look with<br> our formal collection</a></div>
</div>

<div class="casual">
    <div><img src="images/casual.jpg" alt="Business Casual"></div>
    <div class="hey"><a href="#"><h1>Business Casual</h1>
    Want to be dressed for the workplace while feeling at home?<br> try our business casual collection for the best of both worlds</a></div>
</div>

<div class="plussize">
    <div><img src="images/plussize.jpg" alt="Plus Size Suits"></div>
    <div class="hey"><a href="#"><h1>Plus Size</h1>
    Live life "large" with our beautiful selection of gorgeous plus size suits</a></div>
</div>

<div class="sweaters">
    <div><img src="images/sweaters.jpg" alt="Sweaters"></div>
    <div class="hey"><a href="#"><h1>Sweaters</h1>
    Show up to Thanksgiving in style with our selection of warm and stylish sweaters</a></div>
</div>

<div class="winter">
    <div><img src="images/winter.png" alt="Winter Gear"></div>
    <div class="hey"><a href="#"><h1>Winter Gear</h1>
    Be warm and handsome with our stunning collection of coats, scarves and more</a></div>
</div>

<div class="shirts">
    <div><img src="images/shirts.jpg" alt="Shirts"></div>
    <div class="hey"><a href="#"><h1>Shirts</h1>
    Look your best while layering down with our stellar selection of crisp and clean shirts</a></div>
</div>

<!-- Accessories Section -->
<div class="therest">
    <div class="shoes">
        <img src="images/shoes.jpg" alt="Shoes">
        <div class="minishoes"><a href="#"><h1>Shoes</h1>What's Batman without<br> Robin? A good suit is nothing<br> without the<br> appropriate footwear</a></div>
    </div>
    
    <div class="shoes">
        <img src="images/ties.jpg" alt="Ties">
        <div class="minishoes"><a href="#"><h1>Ties</h1>Make your central piece a<br> centerpiece with our selection of <br>floral, vibrant and smooth ties</a></div>
    </div>
    
    <div class="shoes">
        <img src="images/belts.jpg" alt="Belts">
        <div class="minishoes"><a href="#"><h1>Belts</h1>Keep your pants and your style<br> up with our collection of <br>designer belts</a></div>
    </div>
    
    <div class="seemore"><h3><a href="#">See more...</a></h3></div>
</div>


<!-- Feedback Section -->
<div class="feedback">
    <div id="panel" class="panel-container">
        <strong>How satisfied are you with our <br /> customer support performance?</strong>
        <div class="ratings-container">
            <div class="rating">
                <img src="https://img.icons8.com/external-neu-royyan-wijaya/64/000000/external-emoji-neumojis-smiley-neu-royyan-wijaya-17.png" alt="Unhappy">
                <small>Unhappy</small>
            </div>
            
            <div class="rating">
                <img src="https://img.icons8.com/external-neu-royyan-wijaya/64/000000/external-emoji-neumojis-smiley-neu-royyan-wijaya-3.png" alt="Neutral"/>
                <small>Neutral</small>
            </div>
            
            <div class="rating active">
                <img src="https://img.icons8.com/external-neu-royyan-wijaya/64/000000/external-emoji-neumojis-smiley-neu-royyan-wijaya-30.png" alt="Satisfied"/>
                <small>Satisfied</small>
            </div>
        </div>
        <button class="btn" id="send">Send Review</button>
    </div>
</div>

<style>
/* Hero Section - Carousel and Testimonials */
.hero-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 4rem 0;
    margin: 3rem 0;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(52, 73, 94, 0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
    opacity: 0.3;
}

.hero-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
}

/* ResponsiveSlides Section */
.carousel-section {
    display: flex;
    justify-content: center;
    width: 100%;
    max-width: 500px;
}

/* Testimonials Section */
.testimonials-section {
    background: white;
    border-radius: 25px;
    padding: 3rem;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
}

.testimonials-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--accent-color, #3498db), var(--primary-color, #2c3e50));
}

.testimonials-wrapper {
    position: relative;
    min-height: 400px;
    display: flex;
    flex-direction: column;
}

.testimonials-header {
    text-align: center;
    margin-bottom: 2rem;
    flex-shrink: 0;
}

.testimonials-header h2 {
    font-size: 2rem;
    color: var(--primary-color, #2c3e50);
    margin-bottom: 0.5rem;
    font-weight: 700;
}

.testimonials-header p {
    font-size: 1rem;
    color: #666;
    font-weight: 300;
}

.testimonials-carousel {
    flex: 1;
    position: relative;
    overflow: hidden;
    min-height: 250px;
    display: flex;
    align-items: center;
}

.testimonial-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.5s ease-in-out, visibility 0.5s ease-in-out;
    display: flex;
    align-items: center;
    justify-content: center;
}

.testimonial-slide.active {
    opacity: 1;
    visibility: visible;
    z-index: 1;
}

.testimonial-content {
    text-align: center;
    padding: 2rem 0;
    width: 100%;
    max-width: 100%;
}

.testimonial-text {
    font-size: 1.2rem;
    line-height: 1.6;
    color: #333;
    margin-bottom: 2rem;
    font-style: italic;
    position: relative;
    padding: 0 1rem;
}

.testimonial-text::before {
    content: '"';
    font-size: 3rem;
    color: #3498db;
    font-family: serif;
    line-height: 1;
    position: absolute;
    top: -1.5rem;
    left: 50%;
    transform: translateX(-50%);
    opacity: 0.7;
}

.testimonial-author {
    padding-top: 1rem;
    border-top: 1px solid #eee;
}

.testimonial-author h4 {
    color: var(--primary-color, #2c3e50);
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.testimonial-author span {
    color: #666;
    font-size: 1rem;
    font-weight: 300;
}

.testimonial-indicators {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 2rem;
    flex-shrink: 0;
    z-index: 2;
    position: relative;
}

.testimonial-indicator {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #ddd;
    cursor: pointer;
    transition: all 0.3s ease;
}

.testimonial-indicator.active {
    background: var(--accent-color, #3498db);
    transform: scale(1.2);
}

.testimonial-indicator:hover {
    background: var(--primary-color, #2c3e50);
    transform: scale(1.1);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .hero-container {
        grid-template-columns: 1fr;
        gap: 3rem;
    }
    
    .carousel-section {
        max-width: 600px;
    }
    
    .testimonials-wrapper {
        min-height: 350px;
    }
}

@media (max-width: 768px) {
    .hero-section {
        padding: 3rem 0;
    }
    
    .hero-container {
        padding: 0 1rem;
        gap: 2rem;
    }
    
    .testimonials-section {
        padding: 2rem;
    }
    
    .testimonials-wrapper {
        min-height: 300px;
    }
    
    .testimonials-header h2 {
        font-size: 1.8rem;
    }
    
    .testimonial-text {
        font-size: 1.1rem;
    }
    
    .testimonial-text::before {
        font-size: 2.5rem;
    }
}

@media (max-width: 480px) {
    .hero-container {
        padding: 0 0.5rem;
    }
    
    .testimonials-section {
        padding: 1.5rem;
    }
    
    .testimonials-wrapper {
        min-height: 280px;
    }
    
    .testimonials-header h2 {
        font-size: 1.5rem;
    }
    
    .testimonials-header p {
        font-size: 0.9rem;
    }
    
    .testimonial-text {
        font-size: 1rem;
    }
    
    .testimonial-text::before {
        font-size: 2rem;
    }
    
    .testimonial-author h4 {
        font-size: 1.1rem;
    }
    
    .testimonial-author span {
        font-size: 0.9rem;
    }
}

/* CEO Section Professional Styling */
.ceo-section {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    color: white;
    padding: 4rem 0;
    margin: 3rem 0;
    position: relative;
    overflow: hidden;
}

.ceo-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="10" cy="50" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="90" cy="30" r="0.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.ceo-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    position: relative;
    z-index: 1;
}

.ceo-header {
    text-align: center;
    margin-bottom: 3rem;
}

.ceo-header h1 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.ceo-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    font-weight: 300;
    letter-spacing: 1px;
}

.ceo-content {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 4rem;
    align-items: center;
}

.ceo-image {
    display: flex;
    justify-content: center;
}

.ceo-image-wrapper {
    position: relative;
    max-width: 300px;
    width: 100%;
}

.ceo-image img {
    width: 100%;
    height: auto;
    border-radius: 15px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease;
}

.ceo-image img:hover {
    transform: scale(1.02);
}

.ceo-badge {
    position: absolute;
    bottom: -15px;
    right: -15px;
    background: linear-gradient(135deg, #3498db, #2980b9);
    color: white;
    padding: 1rem 1.5rem;
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    text-align: center;
    min-width: 120px;
}

.badge-title {
    display: block;
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.badge-company {
    display: block;
    font-size: 0.9rem;
    opacity: 0.9;
}

.ceo-message {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 3rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.message-content h2 {
    font-size: 2.5rem;
    font-weight: 600;
    margin-bottom: 2rem;
    color: #ecf0f1;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
}

.message-text {
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 1.5rem;
    opacity: 0.95;
    text-align: justify;
}

.ceo-signature {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 2px solid rgba(255, 255, 255, 0.3);
}

.signature-line {
    width: 200px;
    height: 2px;
    background: linear-gradient(90deg, #3498db, #2980b9);
    margin-bottom: 1rem;
}

.signature-details h3 {
    font-size: 1.8rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #ecf0f1;
}

.signature-details p {
    font-size: 1rem;
    opacity: 0.8;
    margin: 0.25rem 0;
    font-weight: 300;
}

/* Responsive Design */
@media (max-width: 968px) {
    .ceo-content {
        grid-template-columns: 1fr;
        gap: 3rem;
        text-align: center;
    }
    
    .ceo-image {
        order: -1;
    }
    
    .message-content h2 {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .ceo-section {
        padding: 3rem 0;
    }
    
    .ceo-header h1 {
        font-size: 2.5rem;
    }
    
    .ceo-message {
        padding: 2rem;
    }
    
    .message-content h2 {
        font-size: 1.8rem;
    }
    
    .message-text {
        font-size: 1rem;
        text-align: left;
    }
}

@media (max-width: 480px) {
    .ceo-container {
        padding: 0 1rem;
    }
    
    .ceo-header h1 {
        font-size: 2rem;
    }
    
    .ceo-message {
        padding: 1.5rem;
    }
    
    .ceo-badge {
        padding: 0.75rem 1rem;
        min-width: 100px;
    }
    
    .badge-title {
        font-size: 1rem;
    }
    
    .badge-company {
        font-size: 0.8rem;
    }
}

.rslides {
  position: relative;
  list-style: none;
  overflow: hidden;
  width: 100%;
  padding: 0;
  margin: 0;
  }

.rslides li {
  -webkit-backface-visibility: hidden;
  position: absolute;
  display: none;
  width: 100%;
  left: 0;
  top: 0;
  }

.rslides li:first-child {
  position: relative;
  display: block;
  float: left;
  }

.rslides img {
  display: block;
  height: auto;
  float: left;
  width: 100%;
  border: 0;
  }
</style>

<script>
  $(function() {
    $(".rslides").responsiveSlides({
  auto: true,             // Boolean: Animate automatically, true or false
  speed: 500,            // Integer: Speed of the transition, in milliseconds
  timeout: 4000,          // Integer: Time between slide transitions, in milliseconds
  pager: false,           // Boolean: Show pager, true or false
  nav: false,             // Boolean: Show navigation, true or false
  random: false,          // Boolean: Randomize the order of the slides, true or false
  pause: false,           // Boolean: Pause on hover, true or false
  pauseControls: true,    // Boolean: Pause when hovering controls, true or false
  prevText: "Previous",   // String: Text for the "previous" button
  nextText: "Next",       // String: Text for the "next" button
  maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
  navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
  manualControls: "",     // Selector: Declare custom pager navigation
  namespace: "rslides",   // String: Change the default namespace used
  before: function(){},   // Function: Before callback
  after: function(){}     // Function: After callback
});
  });
</script>

<?php include 'footer.php'; ?>
