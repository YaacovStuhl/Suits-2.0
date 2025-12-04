    </main>
    
    <!-- Site Footer -->
    <footer class="site-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Simply Suits</h3>
                <p>Premium quality suits for every occasion. From formal events to business casual, we have the perfect suit for you.</p>
            </div>
            
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#collections">Collections</a></li>
                    <li><a href="#sizechart">Size Chart</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4>Customer Service</h4>
                <ul>
                    <li><a href="#shipping">Shipping Info</a></li>
                    <li><a href="#returns">Returns & Exchanges</a></li>
                    <li><a href="#sizeguide">Size Guide</a></li>
                    <li><a href="#care">Care Instructions</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h4>Connect With Us</h4>
                <div class="social-links">
                    <a href="#" class="social-link">Facebook</a>
                    <a href="#" class="social-link">Instagram</a>
                    <a href="#" class="social-link">Twitter</a>
                    <a href="#" class="social-link">Pinterest</a>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Simply Suits. All rights reserved.</p>
            <p>Designed with passion for quality and style.</p>
        </div>
    </footer>
    
    <!-- JavaScript Files -->
    <script src="suits.js"></script>
    
    <!-- SlimMenu Initialization -->
    <script>
        $(document).ready(function() {
            $('.slimmenu').slimmenu({
                resizeWidth: '768',
                initiallyVisible: false,
                collapserTitle: 'Main Menu',
                animSpeed: 'medium',
                easingEffect: null,
                indentChildren: false,
                childrenIndenter: '&nbsp;&nbsp;',
                expandIcon: '<i>&#9660;</i>',
                collapseIcon: '<i>&#9650;</i>'
            });
        });
    </script>
    
    <!-- Sticky Navigation Script - Removed color change functionality -->
    <script>
        // Navigation remains consistently styled - no color changes on scroll
    </script>
    
    <!-- Additional Footer Styles -->
    <style>
        .site-footer {
            background-color: var(--primary-color);
            color: var(--secondary-color);
            padding: 3rem 0 1rem;
            margin-top: 4rem;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .footer-section h3,
        .footer-section h4 {
            margin-bottom: 1rem;
            color: var(--secondary-color);
        }
        
        .footer-section ul {
            list-style: none;
            padding: 0;
        }
        
        .footer-section ul li {
            margin-bottom: 0.5rem;
        }
        
        .footer-section a {
            color: var(--secondary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-section a:hover {
            color: var(--accent-color);
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .social-link {
            padding: 0.5rem 1rem;
            background-color: var(--accent-color);
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        
        .social-link:hover {
            background-color: var(--secondary-color);
            color: var(--primary-color);
        }
        
        .footer-bottom {
            border-top: 1px solid var(--dark-gray);
            padding-top: 1rem;
            text-align: center;
            color: var(--dark-gray);
        }
        
        .footer-bottom p {
            margin: 0.25rem 0;
        }
        
        @media (max-width: 768px) {
            .footer-content {
                grid-template-columns: 1fr;
                text-align: center;
            }
            
            .social-links {
                justify-content: center;
            }
        }
    </style>
</body>
</html>
