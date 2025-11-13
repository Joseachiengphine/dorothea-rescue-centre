<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dorothea Rescue Centre - Providing hope, care, and a safe home for vulnerable children in Africa.">
    <title>Dorothea Rescue Centre - A Heart of Mercy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --jungle-green: #29AB87;
            --yellow: #FFFF00;
            --maroon: #4E1B1B;
            --dark-maroon: #3A1414;
            --cream: #F5F5DC;
            --white: #FFFFFF;
            --black: #000000;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--black);
            overflow-x: hidden;
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 0.6rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo-container img {
            height: 42px;
            width: auto;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--maroon);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--maroon);
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: var(--jungle-green);
        }

        .login-btn {
            background: var(--maroon);
            color: var(--white);
            padding: 0.45rem 1.1rem;
            border-radius: 5px;
            font-weight: 600;
            transition: background 0.3s;
            text-decoration: none;
            display: inline-block;
            font-size: 0.95rem;
        }

        .login-btn:hover {
            background: var(--dark-maroon);
            color: var(--white);
        }

        .nav-cta {
            background: var(--jungle-green);
            color: var(--white);
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s;
        }

        .nav-cta:hover {
            background: #238A6F;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            position: relative;
            margin-top: 70px;
        }

        .hero-image-container {
            width: 100%;
            height: calc(100vh - 70px);
            position: relative;
            overflow: hidden;
        }

        .hero-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-overlay {
            display: none;
        }

        .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: var(--maroon);
            z-index: 10;
            width: 85%;
            max-width: 670px;
            background: rgba(255, 255, 255, 0.8);
            padding: 1.5rem 1.75rem;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .hero-headline {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.2;
            color: var(--maroon);
        }

        .hero-subtitle {
            font-size: 1.05rem;
            font-weight: 400;
            margin-bottom: 1.75rem;
            color: var(--dark-maroon);
        }

        .hero-cta-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.85rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            display: inline-block;
        }

        .btn-primary {
            background: var(--yellow);
            color: var(--maroon);
        }

        .btn-primary:hover {
            background: #E6E600;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 255, 0, 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: var(--maroon);
            border: 2px solid var(--maroon);
        }

        .btn-secondary:hover {
            background: var(--maroon);
            color: var(--white);
        }

        /* Decorative Border Pattern - Using Ankara Image */
        .pattern-border {
            height: 120px;
            position: relative;
            overflow: hidden;
            background-image: url('{{ asset("images/flowing_ribbons.jpg") }}');
            background-repeat: repeat-x;
            background-size: auto 100%;
            background-position: center;
        }

        /* Golden Bar Overlay */
        .golden-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 56px;
            background: linear-gradient(135deg, var(--maroon) 0%, var(--dark-maroon) 100%);
            opacity: 0.9;
            z-index: 5;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 -5px 20px rgba(78, 27, 27, 0.3);
        }

        .golden-bar-text {
            color: var(--white);
            font-size: 1.2rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Mission Section */
        .mission-section {
            margin-top: -70px;
            padding: 4.75rem 5% 5rem;
            background: var(--cream);
            position: relative;
            overflow: hidden;
        }

        .mission-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('{{ asset("images/background-2.jpg") }}');
            background-size: cover;
            background-position: center;
            opacity: 0.15;
            z-index: 0;
        }

        .mission-section .container {
            position: relative;
            z-index: 1;
        }

        /* Education Section Background */
        .education-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('{{ asset("images/hope.jpg") }}');
            background-size: cover;
            background-position: center;
            opacity: 0.15;
            z-index: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--maroon);
            text-align: center;
            margin-top: 0;
            margin-bottom: 3rem;
        }

        .mission-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }

        .mission-text {
            font-size: 1.2rem;
            line-height: 1.8;
            color: var(--dark-maroon);
        }

        .mission-text p {
            margin-bottom: 1.5rem;
        }

        .mission-image {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .mission-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Features Section */
        .features-section {
            padding: 5rem 5%;
            background: var(--white);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .feature-card {
            background: var(--white);
            padding: 2rem;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: var(--jungle-green);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .feature-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--maroon);
            margin-bottom: 1rem;
        }

        .feature-description {
            color: #666;
            line-height: 1.6;
        }

        /* Call to Action Section */
        .cta-section {
            padding: 5rem 5%;
            background: var(--cream);
            position: relative;
            overflow: hidden;
        }

        .cta-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }

        .cta-image {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .cta-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        .cta-text {
            text-align: left;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--maroon);
            margin-bottom: 1.5rem;
        }

        .cta-description {
            font-size: 1.2rem;
            line-height: 1.8;
            color: var(--dark-maroon);
            margin-bottom: 2rem;
        }

        .cta-buttons {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        /* Footer */
        .footer {
            background: var(--maroon);
            color: var(--white);
            padding: 3rem 5%;
            text-align: center;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-logo {
            margin-bottom: 1.5rem;
        }

        .footer-logo img {
            height: 60px;
            filter: brightness(0) invert(1);
        }

        .footer-text {
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .footer-tagline {
            font-size: 1.2rem;
            font-style: italic;
            color: var(--yellow);
            margin-top: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .nav-actions {
                display: none;
            }

            .hero-headline {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .hero-content {
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
                width: 90%;
                max-width: 800px;
            }

            .mission-content {
                grid-template-columns: 1fr;
            }

            .hero-cta-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="logo-container">
            <img src="{{ asset('images/dorothea_rescue_logo.jpeg') }}" alt="Dorothea Rescue Centre Logo">
            <div class="logo-text">Dorothea Rescue Centre</div>
        </div>
        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#programs">Programs</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        <div class="nav-actions">
            <a href="#donate" class="nav-cta">Donate</a>
            <a href="/admin/login" class="login-btn">Login</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-image-container">
            <img src="{{ asset('images/powerful-child-portrait.png') }}" alt="Hero Image - Hope and Compassion">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h1 class="hero-headline">IN THE HEART OF EVERY CHILD IS A HUNGER FOR HOME</h1>
                <p class="hero-subtitle">Children without families are the most vulnerable people in the world. We provide hope, care, and a safe home.</p>
                <div class="hero-cta-buttons">
                    <a href="#donate" class="btn btn-primary">Donate Now</a>
                    <a href="#about" class="btn btn-secondary">Learn More</a>
                </div>
            </div>
            <div class="golden-bar">
                <div class="golden-bar-text">A Heart of Mercy</div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission-section" id="about">
        <div class="container">
            <h2 class="section-title">Our Mission</h2>
            <div class="mission-content">
                <div class="mission-text">
                    <p>Dorothea Rescue Centre is dedicated to providing a safe haven, education, and comprehensive care for vulnerable children in Africa. We believe every child deserves love, protection, and the opportunity to thrive.</p>
                    <p>Through our programs, we offer rescue services, education, healthcare, family reunification support, and a nurturing environment where children can heal, grow, and build a brighter future.</p>
                    <p>With a heart of mercy, we work tirelessly to ensure that no child is left behind, providing them with the tools and support they need to overcome adversity and achieve their dreams.</p>
                </div>
                <div class="mission-image">
                    <img src="{{ asset('images/coming_together.jpg') }}" alt="Community and Care">
                </div>
            </div>
        </div>
    </section>

    <!-- Family Reunification Section -->
    <section class="family-section" style="padding: 5rem 5%; background: var(--cream);">
        <div class="container">
            <h2 class="section-title">Family Reunification</h2>
            <div class="mission-content">
                <div class="mission-image">
                    <img src="{{ asset('images/family-reunification.png') }}" alt="Family Reunification">
                </div>
                <div class="mission-text">
                    <p>At Dorothea Rescue Centre, we believe in the power of family. Our family reunification program works tirelessly to bring children back to their loved ones.</p>
                    <p>We provide comprehensive support and resources to ensure stable, loving home environments where every child can thrive and grow in the care of their family.</p>
                    <p>Through counseling, financial assistance, and ongoing follow-up, we help families rebuild their bonds and create lasting, positive change for their children's futures.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Education Section -->
    <section class="family-section education-bg" style="padding: 5rem 5%; background: var(--white); position: relative; overflow: hidden;">
        <div class="container" style="position: relative; z-index: 1;">
            <h2 class="section-title">Education & Learning</h2>
            <div class="mission-content">
                <div class="mission-text">
                    <p>Education is the foundation of a brighter future. At Dorothea Rescue Centre, we are committed to providing quality education and learning opportunities for every child in our care.</p>
                    <p>Through our education programs, we ensure that children have access to schools, learning materials, and the support they need to excel academically and reach their full potential.</p>
                    <p>We believe that education empowers children to break cycles of poverty and build the skills they need to create positive change in their lives and communities.</p>
                </div>
                <div class="mission-image">
                    <img src="{{ asset('images/holding_books.jpg') }}" alt="Education and Learning">
                </div>
            </div>
        </div>
    </section>

    <!-- Features/Programs Section -->
    <section class="features-section" id="programs">
        <div class="container">
            <h2 class="section-title">Our Programs</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🎓</div>
                    <h3 class="feature-title">Education</h3>
                    <p class="feature-description">Providing quality education and learning opportunities to help children reach their full potential and build a better future.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🏥</div>
                    <h3 class="feature-title">Health & Care</h3>
                    <p class="feature-description">Comprehensive healthcare services ensuring every child receives the medical attention and care they need to thrive.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">👨‍👩‍👧</div>
                    <h3 class="feature-title">Family Reunification</h3>
                    <p class="feature-description">Supporting families to reunite and providing ongoing assistance to ensure stable, loving home environments.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🤝</div>
                    <h3 class="feature-title">Community Support</h3>
                    <p class="feature-description">Building strong community networks and partnerships to create lasting positive change for children and families.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta-section" id="donate">
        <div class="container">
            <div class="cta-content">
                <div class="cta-image">
                    <img src="{{ asset('images/hand_gently.jpg') }}" alt="Heart of Mercy - Support Our Mission">
                </div>
                <div class="cta-text">
                    <h2 class="cta-title">Join Us in Making a Difference</h2>
                    <p class="cta-description">
                        Every child deserves love, care, and the opportunity to thrive. Your support helps us provide safe homes, education, healthcare, and hope to vulnerable children across Africa.
                    </p>
                    <p class="cta-description">
                        Together, we can create lasting change and give every child the chance to build a brighter future.
                    </p>
                    <div class="cta-buttons">
                        <a href="#donate" class="btn btn-primary">Donate Now</a>
                        <a href="#contact" class="btn btn-secondary">Get Involved</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="footer-content">
            <div class="footer-logo">
                <img src="{{ asset('images/dorothea_rescue_logo.jpeg') }}" alt="Dorothea Rescue Centre Logo">
            </div>
            <p class="footer-text">Dorothea Rescue Centre</p>
            <p class="footer-text">Providing hope, care, and a safe home for vulnerable children</p>
            <p class="footer-tagline">A Heart of Mercy</p>
        </div>
    </footer>
</body>
</html>

