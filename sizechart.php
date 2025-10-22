<?php
// Set page title
$page_title = "Size Chart";
?>

<?php include 'header.php'; ?>

<div class="size-chart-container">
    <div class="size-chart-header">
        <h1>Professional Size Chart</h1>
        <p>Find your perfect fit with our comprehensive sizing guide</p>
    </div>
    
    <div class="size-chart-content">
        <div class="chart-intro">
            <h2>How to Measure</h2>
            <div class="measurement-guide">
                <div class="measurement-item">
                    <div class="measurement-icon">👔</div>
                    <h3>Chest</h3>
                    <p>Measure around the fullest part of your chest, keeping the tape measure horizontal.</p>
                </div>
                <div class="measurement-item">
                    <div class="measurement-icon">👖</div>
                    <h3>Waist</h3>
                    <p>Measure around your natural waistline, typically 1-2 inches above your belly button.</p>
                </div>
                <div class="measurement-item">
                    <div class="measurement-icon">👕</div>
                    <h3>Sleeve</h3>
                    <p>Measure from the center of your neck to your wrist bone, with arm slightly bent.</p>
                </div>
            </div>
        </div>
        
        <div class="size-tables">
            <div class="table-container">
                <h3>Jacket Sizing</h3>
                <div class="table-wrapper">
                    <table class="size-table">
                        <thead>
                            <tr>
                                <th>Size</th>
                                <th>Chest</th>
                                <th>Waist</th>
                                <th>Sleeve</th>
                                <th>Fit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="size-label">XS</td>
                                <td>34" - 36"</td>
                                <td>28" - 30"</td>
                                <td>32"</td>
                                <td>Slim</td>
                            </tr>
                            <tr>
                                <td class="size-label">S</td>
                                <td>37" - 39"</td>
                                <td>31" - 33"</td>
                                <td>33"</td>
                                <td>Slim</td>
                            </tr>
                            <tr>
                                <td class="size-label">M</td>
                                <td>40" - 42"</td>
                                <td>34" - 36"</td>
                                <td>34"</td>
                                <td>Regular</td>
                            </tr>
                            <tr>
                                <td class="size-label">L</td>
                                <td>43" - 45"</td>
                                <td>37" - 39"</td>
                                <td>35"</td>
                                <td>Regular</td>
                            </tr>
                            <tr>
                                <td class="size-label">XL</td>
                                <td>46" - 48"</td>
                                <td>40" - 42"</td>
                                <td>36"</td>
                                <td>Regular</td>
                            </tr>
                            <tr>
                                <td class="size-label">XXL</td>
                                <td>49" - 51"</td>
                                <td>43" - 45"</td>
                                <td>37"</td>
                                <td>Relaxed</td>
                            </tr>
                            <tr>
                                <td class="size-label">XXXL</td>
                                <td>52" - 54"</td>
                                <td>46" - 48"</td>
                                <td>38"</td>
                                <td>Relaxed</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="table-container">
                <h3>Pants Sizing</h3>
                <div class="table-wrapper">
                    <table class="size-table">
                        <thead>
                            <tr>
                                <th>Size</th>
                                <th>Waist</th>
                                <th>Inseam</th>
                                <th>Fit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="size-label">28</td>
                                <td>28" - 30"</td>
                                <td>30" - 32"</td>
                                <td>Slim</td>
                            </tr>
                            <tr>
                                <td class="size-label">30</td>
                                <td>30" - 32"</td>
                                <td>30" - 32"</td>
                                <td>Slim</td>
                            </tr>
                            <tr>
                                <td class="size-label">32</td>
                                <td>32" - 34"</td>
                                <td>32" - 34"</td>
                                <td>Regular</td>
                            </tr>
                            <tr>
                                <td class="size-label">34</td>
                                <td>34" - 36"</td>
                                <td>32" - 34"</td>
                                <td>Regular</td>
                            </tr>
                            <tr>
                                <td class="size-label">36</td>
                                <td>36" - 38"</td>
                                <td>32" - 34"</td>
                                <td>Regular</td>
                            </tr>
                            <tr>
                                <td class="size-label">38</td>
                                <td>38" - 40"</td>
                                <td>32" - 34"</td>
                                <td>Relaxed</td>
                            </tr>
                            <tr>
                                <td class="size-label">40</td>
                                <td>40" - 42"</td>
                                <td>32" - 34"</td>
                                <td>Relaxed</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="fit-guide">
            <h3>Fit Guide</h3>
            <div class="fit-options">
                <div class="fit-option">
                    <h4>Slim Fit</h4>
                    <p>Tailored cut with a modern silhouette. Perfect for those who prefer a fitted look.</p>
                </div>
                <div class="fit-option">
                    <h4>Regular Fit</h4>
                    <p>Classic cut with comfortable room. Ideal for professional and everyday wear.</p>
                </div>
                <div class="fit-option">
                    <h4>Relaxed Fit</h4>
                    <p>Comfortable cut with extra room. Great for those who prefer a looser fit.</p>
                </div>
            </div>
        </div>
        
        <div class="size-chart-footer">
            <div class="help-section">
                <h3>Need Help Finding Your Size?</h3>
                <p>Our expert stylists are here to help you find the perfect fit. Contact us for personalized sizing assistance.</p>
                <div class="help-actions">
                    <a href="#contact" class="btn btn-primary">Contact Stylist</a>
                    <a href="index.php" class="btn btn-secondary">Back to Collections</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.size-chart-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 2rem 0;
}

.size-chart-header {
    text-align: center;
    margin-bottom: 3rem;
    padding: 0 2rem;
}

.size-chart-header h1 {
    font-size: 3rem;
    color: var(--primary-color, #2c3e50);
    margin-bottom: 1rem;
    font-weight: 700;
}

.size-chart-header p {
    font-size: 1.2rem;
    color: #666;
    max-width: 600px;
    margin: 0 auto;
}

.size-chart-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.chart-intro {
    background: white;
    padding: 3rem;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-bottom: 3rem;
}

.chart-intro h2 {
    text-align: center;
    color: var(--primary-color, #2c3e50);
    margin-bottom: 2rem;
    font-size: 2rem;
}

.measurement-guide {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.measurement-item {
    text-align: center;
    padding: 2rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 10px;
    transition: transform 0.3s ease;
}

.measurement-item:hover {
    transform: translateY(-5px);
}

.measurement-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.measurement-item h3 {
    color: var(--primary-color, #2c3e50);
    margin-bottom: 1rem;
    font-size: 1.5rem;
}

.measurement-item p {
    color: #666;
    line-height: 1.6;
}

.size-tables {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
    gap: 3rem;
    margin-bottom: 3rem;
}

.table-container {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.table-container h3 {
    color: var(--primary-color, #2c3e50);
    margin-bottom: 1.5rem;
    font-size: 1.8rem;
    text-align: center;
}

.table-wrapper {
    overflow-x: auto;
}

.size-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
}

.size-table th {
    background: var(--primary-color, #2c3e50);
    color: white;
    padding: 1rem;
    text-align: center;
    font-weight: 600;
    font-size: 1.1rem;
}

.size-table td {
    padding: 1rem;
    text-align: center;
    border-bottom: 1px solid #eee;
    transition: background-color 0.3s ease;
}

.size-table tr:hover td {
    background-color: #f8f9fa;
}

.size-label {
    font-weight: 700;
    color: var(--accent-color, #3498db);
    background-color: #f8f9fa;
}

.fit-guide {
    background: white;
    padding: 3rem;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-bottom: 3rem;
}

.fit-guide h3 {
    text-align: center;
    color: var(--primary-color, #2c3e50);
    margin-bottom: 2rem;
    font-size: 2rem;
}

.fit-options {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.fit-option {
    text-align: center;
    padding: 2rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 10px;
    transition: transform 0.3s ease;
}

.fit-option:hover {
    transform: translateY(-5px);
}

.fit-option h4 {
    color: var(--primary-color, #2c3e50);
    margin-bottom: 1rem;
    font-size: 1.5rem;
}

.fit-option p {
    color: #666;
    line-height: 1.6;
}

.size-chart-footer {
    background: white;
    padding: 3rem;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.help-section h3 {
    color: var(--primary-color, #2c3e50);
    margin-bottom: 1rem;
    font-size: 2rem;
}

.help-section p {
    color: #666;
    margin-bottom: 2rem;
    font-size: 1.1rem;
    line-height: 1.6;
}

.help-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn {
    padding: 0.75rem 2rem;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-block;
}

.btn-primary {
    background-color: var(--primary-color, #2c3e50);
    color: white;
}

.btn-primary:hover {
    background-color: var(--accent-color, #3498db);
    transform: translateY(-2px);
}

.btn-secondary {
    background-color: #95a5a6;
    color: white;
}

.btn-secondary:hover {
    background-color: #7f8c8d;
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .size-chart-header h1 {
        font-size: 2rem;
    }
    
    .size-tables {
        grid-template-columns: 1fr;
    }
    
    .chart-intro,
    .fit-guide,
    .size-chart-footer {
        padding: 2rem;
    }
    
    .help-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn {
        width: 100%;
        max-width: 200px;
    }
}

@media (max-width: 480px) {
    .size-chart-container {
        padding: 1rem 0;
    }
    
    .size-chart-content {
        padding: 0 1rem;
    }
    
    .chart-intro,
    .fit-guide,
    .size-chart-footer {
        padding: 1.5rem;
    }
}
</style>

<?php include 'footer.php'; ?>
