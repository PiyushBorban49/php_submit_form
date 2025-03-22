<?php
// check_visa.php

// Add a small delay to simulate server processing
sleep(1);

// Check if form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the country value
    $country = isset($_POST['country']) ? $_POST['country'] : '';
    
    // Define the message variable
    $message = '';
    $class = 'result';
    $flag = '';
    
    // Add flag emoji based on country
    switch($country) {
        case 'USA': $flag = '🇺🇸'; break;
        case 'Canada': $flag = '🇨🇦'; break;
        case 'India': $flag = '🇮🇳'; break;
        case 'UK': $flag = '🇬🇧'; break;
        case 'Australia': $flag = '🇦🇺'; break;
        default: $flag = '';
    }
    
    // Validate the country selection
    if (empty($country)) {
        $message = 'Invalid country selection.';
        $class = 'error';
    } else {
        // Determine visa requirements based on country
        switch ($country) {
            case 'USA':
                $message = 'Visa required for most applicants.';
                $additionalInfo = 'Most visitors need to apply for a visa before travel. The application process can take 2-3 weeks.';
                $processingTime = '2-3 weeks';
                $costRange = '$160-$190';
                $validityPeriod = 'Up to 10 years';
                $requirements = ['Valid passport', 'Completed application form', 'Proof of funds', 'Intent to return'];
                break;
            case 'Canada':
                $message = 'Visa required unless you have an eTA.';
                $additionalInfo = 'Many visitors can apply for an Electronic Travel Authorization (eTA) online instead of a traditional visa.';
                $processingTime = '1-4 weeks';
                $costRange = 'CAD $100-$150';
                $validityPeriod = 'Up to 10 years';
                $requirements = ['Valid passport', 'Completed application form', 'Proof of funds', 'Clean criminal record'];
                break;
            case 'India':
                $message = 'Visa required before travel.';
                $additionalInfo = 'E-visas are available for tourists from many countries. Application should be made at least 4 days before travel.';
                $processingTime = '4-7 days';
                $costRange = '$25-$80';
                $validityPeriod = '30 days to 1 year';
                $requirements = ['Valid passport', 'Return ticket', 'Hotel reservation', 'Recent photo'];
                break;
            case 'UK':
                $message = 'Visa depends on the duration of stay.';
                $additionalInfo = 'Visitors from many countries can stay up to 6 months without a visa. Longer stays require appropriate visas.';
                $processingTime = '3-6 weeks';
                $costRange = '£95-£115';
                $validityPeriod = '6 months to 10 years';
                $requirements = ['Valid passport', 'Financial documentation', 'Travel itinerary', 'Accommodation details'];
                break;
            case 'Australia':
                $message = 'eVisa available for eligible travelers.';
                $additionalInfo = 'Most visitors can apply for an Electronic Travel Authority (ETA) or eVisitor visa online.';
                $processingTime = '1-2 days';
                $costRange = 'AUD $20-$140';
                $validityPeriod = '3 months to 1 year';
                $requirements = ['Valid passport', 'Good health', 'Good character', 'No debts to Australian government'];
                break;
            default:
                $message = 'Information not available for this country.';
                $additionalInfo = '';
                $processingTime = 'Unknown';
                $costRange = 'Unknown';
                $validityPeriod = 'Unknown';
                $requirements = [];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visa Check Result</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            background-image: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            color: #333;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            min-height: 100vh;
        }
        
        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
            animation: fadeInSlideUp 0.8s ease forwards;
            opacity: 0;
            transform: translateY(20px);
            position: relative;
            overflow: hidden;
        }
        
        @keyframes fadeInSlideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        h1 {
            color: #3a56e4;
            margin-bottom: 25px;
            text-align: center;
            font-size: 28px;
            position: relative;
            padding-bottom: 10px;
            animation: fadeIn 0.8s ease forwards 0.3s;
            opacity: 0;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(to right, #3a56e4, #5e72e4);
            border-radius: 3px;
            animation: lineGrow 1s ease forwards 0.6s;
            transform: translateX(-50%) scaleX(0);
        }
        
        @keyframes lineGrow {
            from { transform: translateX(-50%) scaleX(0); }
            to { transform: translateX(-50%) scaleX(1); }
        }
        
        .result {
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
            background-color: #f0f7ff;
            border-left: 5px solid #3a56e4;
            animation: slideIn 0.5s ease-out forwards 0.7s;
            opacity: 0;
            transform: translateX(-20px);
            box-shadow: 0 4px 15px rgba(58, 86, 228, 0.08);
            transition: all 0.3s;
        }
        
        .result:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(58, 86, 228, 0.12);
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .error {
            background-color: #fff0f0;
            color: #e53e3e;
            border-left: 5px solid #e53e3e;
            animation: shake 0.5s ease-in-out forwards;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .country-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            animation: fadeIn 0.5s ease forwards 0.9s;
            opacity: 0;
        }
        
        .flag-icon {
            font-size: 36px;
            margin-right: 15px;
            animation: flagWave 3s ease-in-out infinite;
            transform-origin: center bottom;
        }
        
        @keyframes flagWave {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(5deg); }
            75% { transform: rotate(-5deg); }
        }
        
        .country-name {
            font-size: 24px;
            font-weight: 600;
            color: #444;
            text-shadow: 1px 1px 0 rgba(255,255,255,0.8);
        }
        
        .requirement {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 15px;
            animation: fadeIn 0.5s ease forwards 1.1s;
            opacity: 0;
            position: relative;
            display: inline-block;
        }
        
        .requirement::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #3a56e4 0%, transparent 100%);
            animation: lineExpand 1s ease forwards 1.5s;
        }
        
        @keyframes lineExpand {
            from { width: 0; }
            to { width: 100%; }
        }
        
        .additional-info {
            background-color: #f9fafc;
            padding: 15px;
            border-radius: 6px;
            margin-top: 15px;
            font-size: 15px;
            color: #555;
            animation: fadeIn 0.5s ease forwards 1.3s;
            opacity: 0;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }
        
        .additional-info:hover {
            background-color: #f5f7fa;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .back-button {
            display: inline-block;
            background: linear-gradient(45deg, #3a56e4, #5e72e4);
            color: white;
            padding: 12px 25px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 20px;
            transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
            box-shadow: 0 4px 6px rgba(58, 86, 228, 0.15);
            animation: fadeIn 0.5s ease forwards 1.5s;
            opacity: 0;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .back-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(255,255,255,0.1), rgba(255,255,255,0.4), rgba(255,255,255,0.1));
            transition: all 0.6s ease;
            z-index: -1;
        }
        
        .back-button:hover {
            background: linear-gradient(45deg, #2c44c9, #4a61e2);
            transform: translateY(-3px);
            box-shadow: 0 7px 14px rgba(58, 86, 228, 0.25);
        }
        
        .back-button:hover::before {
            left: 100%;
        }
        
        .back-button:active {
            transform: translateY(2px);
            box-shadow: 0 3px 10px rgba(58, 86, 228, 0.2);
        }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
            animation: fadeIn 0.5s ease forwards 1.7s;
            opacity: 0;
        }
        
        .disclaimer {
            font-size: 13px;
            color: #888;
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            animation: fadeIn 0.5s ease forwards 1.6s;
            opacity: 0;
        }
        
        /* Advanced features - detailed requirements cards */
        .requirements-section {
            margin-top: 30px;
            animation: fadeIn 0.5s ease forwards 1.4s;
            opacity: 0;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #444;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .section-title::before {
            content: '📋';
            margin-right: 10px;
            font-size: 20px;
        }
        
        .requirements-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .requirement-card {
            background-color: white;
            border-radius: 6px;
            padding: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            opacity: 0;
            transform: translateY(20px);
            animation: cardAppear 0.5s forwards;
            animation-delay: calc(1.5s + var(--delay) * 0.1s);
        }
        
        @keyframes cardAppear {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .requirement-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .requirement-icon {
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .requirement-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 5px;
            color: #444;
        }
        
        .info-row {
            display: flex;
            align-items: center;
            margin-top: 20px;
            animation: fadeIn 0.5s ease forwards 1.2s;
            opacity: 0;
        }
        
        .info-label {
            font-weight: 600;
            margin-right: 10px;
            min-width: 140px;
        }
        
        .info-value {
            color: #3a56e4;
            font-weight: 500;
        }
        
        .ripple {
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.5s linear;
        }
        
        @keyframes ripple {
            to { transform: scale(2.5); opacity: 0; }
        }
        
        /* Responsive styles */
        @media (max-width: 600px) {
            body {
                padding: 15px;
            }
            
            .card {
                padding: 20px;
            }
            
            h1 {
                font-size: 24px;
            }
            
            .requirements-grid {
                grid-template-columns: 1fr;
            }
            
            .info-row {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .info-label {
                margin-bottom: 5px;
            }
        }
        
        .shake {
            animation: shake 0.5s ease-in-out;
        }
    </style>
</head>
<body>
<?php if (isset($country) && !empty($country)): ?>
    <div class="card">
        <h1>Visa Requirement Results</h1>
        
        <div class="country-header">
            <div class="flag-icon"><?php echo $flag; ?></div>
            <div class="country-name"><?php echo $country; ?></div>
        </div>
        
        <div class="<?php echo $class; ?>">
            <div class="requirement"><?php echo $message; ?></div>
            
            <?php if (isset($additionalInfo) && !empty($additionalInfo)): ?>
                <div class="additional-info">
                    <?php echo $additionalInfo; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if (isset($processingTime) && isset($costRange) && isset($validityPeriod)): ?>
            <div class="info-row">
                <div class="info-label">Processing Time:</div>
                <div class="info-value"><?php echo $processingTime; ?></div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Cost Range:</div>
                <div class="info-value"><?php echo $costRange; ?></div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Validity Period:</div>
                <div class="info-value"><?php echo $validityPeriod; ?></div>
            </div>
        <?php endif; ?>
        
        <?php if (isset($requirements) && !empty($requirements)): ?>
            <div class="requirements-section">
                <div class="section-title">Required Documents</div>
                <div class="requirements-grid">
                    <?php foreach ($requirements as $index => $req): ?>
                        <div class="requirement-card" style="--delay: <?php echo $index; ?>">
                            <div class="requirement-icon">📄</div>
                            <div class="requirement-title"><?php echo $req; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
        
        <a href="index.html" class="back-button">Back to Search</a>
    </div>
    
    <div class="disclaimer">
        <p>Disclaimer: This information is provided for general guidance only and may change without notice. Please check with the relevant embassy or consulate for the most up-to-date information before making travel arrangements.</p>
    </div>
<?php else: ?>
    <div class="card">
        <h1>Visa Requirement Checker</h1>
        <p class="subtitle">Please select a country to check visa requirements.</p>
        <a href="index.html" class="back-button">Back to Search</a>
    </div>
<?php endif; ?>

<div class="footer">
    <p>© 2025 Visa Information Service. Updated information as of March 2025.</p>
</div>
</body>
</html>
