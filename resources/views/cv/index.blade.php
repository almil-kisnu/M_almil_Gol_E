<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV - Mohammad Almil Hisnullah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --dark-bg: #111827;
            --card-bg: #1f2937;
            --text-light: #f3f4f6;
            --text-muted: #9ca3af;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--dark-bg);
            color: var(--text-light);
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            background-color: rgba(17, 24, 39, 0.9);
            backdrop-filter: blur(10px);
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--text-light) !important;
            font-size: 1.5rem;
        }

        .nav-link {
            color: var(--text-light) !important;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            background: radial-gradient(circle at top right, rgba(67, 97, 238, 0.1), transparent 40%),
                        radial-gradient(circle at bottom left, rgba(72, 149, 239, 0.1), transparent 40%);
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.1;
            background: linear-gradient(to right, #4361ee, #4cc9f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
        }

        .hero p.lead {
            font-size: 1.5rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
        }

        .btn-glow {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 1px;
            border: none;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.4);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .btn-glow:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(67, 97, 238, 0.6);
            color: white;
        }

        /* Stats Section */
        .stats-card {
            background-color: var(--card-bg);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            border: 1px solid rgba(255,255,255,0.05);
            transition: transform 0.3s;
            height: 100%;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
        }

        .counter {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--primary-color);
            display: block;
        }

        /* Skills */
        .skill-bar {
            background-color: rgba(255,255,255,0.1);
            border-radius: 10px;
            height: 10px;
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .skill-progress {
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            height: 100%;
            border-radius: 10px;
            width: 0;
            transition: width 1.5s ease-in-out;
        }

        /* Experience/Timeline */
        .timeline-item {
            border-left: 2px solid var(--primary-color);
            padding-left: 2rem;
            position: relative;
            margin-bottom: 3rem;
        }

        .timeline-item::before {
            content: '';
            width: 16px;
            height: 16px;
            background-color: var(--dark-bg);
            border: 2px solid var(--primary-color);
            border-radius: 50%;
            position: absolute;
            left: -9px;
            top: 0;
        }

        .timeline-year {
            color: var(--accent-color);
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
        }

        /* Portfolio Grid */
        .portfolio-item {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            aspect-ratio: 16/9;
            background-color: var(--card-bg);
            border: 1px solid rgba(255,255,255,0.05);
        }

        .portfolio-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(17, 24, 39, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .portfolio-item:hover .portfolio-overlay {
            opacity: 1;
        }

        footer {
            background-color: #0b0f19;
            padding: 3rem 0;
            margin-top: 5rem;
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        
        h5.text-muted {
            color: var(--text-light) !important; /* Mengubah jadi biru tema Anda */
        }

        p.text-muted {
            color: var(--text-muted) !important; /* Mengubah jadi biru tema Anda */
        }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }

    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">almil'cv.</a>
            <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#skills">Skills</a></li>
                    <li class="nav-item"><a class="nav-link" href="#experience">Experience</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 animate-up">
                    <span class="text-uppercase text-primary fw-bold letter-spacing-2">Full Stack Developer</span>
                    <h1 class="mt-3 mb-4">Mohammad Almil<br>Hisnullah</h1>
                    <p class="lead">Transforming complex problems into elegant, scalable solutions. Trusted by hundreds of companies to deliver high-performance web applications.</p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="#contact" class="btn btn-glow">Hire Me</a>
                        <a href="#portfolio" class="btn btn-outline-light rounded-pill px-4 py-2 fw-bold">View Portfolio</a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block animate-up delay-200">
                    <!-- Placeholder for professional image or 3D element -->
                    <div style="width: 100%; height: 400px; background: radial-gradient(circle, var(--secondary-color), transparent); filter: blur(40px); opacity: 0.4; border-radius: 50%;"></div>
                    <img src="{{ asset('6.webp') }}" alt="Profile" class="img-fluid rounded-4 shadow-lg position-relative" style="border: 1px solid rgba(255,255,255,0.1); z-index: 1;">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4 col-sm-6 animate-up delay-100">
                    <div class="stats-card">
                        <span class="counter">300+</span>
                        <h5 class="mt-2 text-muted">Companies Handled</h5>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 animate-up delay-200">
                    <div class="stats-card">
                        <span class="counter">50+</span>
                        <h5 class="mt-2 text-muted">Projects Completed</h5>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 animate-up delay-300">
                    <div class="stats-card">
                        <span class="counter">98%</span>
                        <h5 class="mt-2 text-muted">Client Satisfaction</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-5">
        <div class="container">
            <h2 class="section-title mb-5 fw-bold"><span class="text-primary">//</span> Technical Proficiency</h2>
            <div class="row">
                <div class="col-md-6 pe-md-5 mb-5 mb-md-0">
                    <h4 class="mb-4 text-light">Backend Development</h4>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>PHP / Laravel</span>
                            <span>95%</span>
                        </div>
                        <div class="skill-bar"><div class="skill-progress" style="width: 95%;"></div></div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>SQL / Database Design</span>
                            <span>90%</span>
                        </div>
                        <div class="skill-bar"><div class="skill-progress" style="width: 90%;"></div></div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>API Development (REST/GraphQL)</span>
                            <span>92%</span>
                        </div>
                        <div class="skill-bar"><div class="skill-progress" style="width: 92%;"></div></div>
                    </div>
                </div>
                <div class="col-md-6 ps-md-5">
                    <h4 class="mb-4 text-light">Frontend Development</h4>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>HTML5 / CSS3 / Bootstrap</span>
                            <span>98%</span>
                        </div>
                        <div class="skill-bar"><div class="skill-progress" style="width: 98%;"></div></div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>JavaScript / Vue.js / React</span>
                            <span>88%</span>
                        </div>
                        <div class="skill-bar"><div class="skill-progress" style="width: 88%;"></div></div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>UI/UX Principles</span>
                            <span>85%</span>
                        </div>
                        <div class="skill-bar"><div class="skill-progress" style="width: 85%;"></div></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section id="experience" class="py-5 bg-darker">
        <div class="container">
            <h2 class="section-title mb-5 fw-bold"><span class="text-primary">//</span> Experience</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="timeline-item">
                        <span class="timeline-year">2020 - Present</span>
                        <h4 class="text-white">Senior Full Stack Developer</h4>
                        <p class="text-primary mb-2">Freelance / Consultant</p>
                        <p class="text-muted">Successfully delivered scalable web solutions for over 100+ corporate clients. Optimized database queries improving load times by 40%. Led migration projects for legacy systems to modern Laravel architectures.</p>
                    </div>
                    <div class="timeline-item">
                        <span class="timeline-year">2018 - 2020</span>
                        <h4 class="text-white">Web Developer</h4>
                        <p class="text-primary mb-2">Tech Solutions Inc.</p>
                        <p class="text-muted">Developed and maintained e-commerce platforms. Collaborated with UI/UX teams to implement responsive designs. Integrated third-party payment gateways and shipping APIs.</p>
                    </div>
                    <div class="timeline-item">
                        <span class="timeline-year">2016 - 2018</span>
                        <h4 class="text-white">Junior Developer</h4>
                        <p class="text-primary mb-2">Creative Agency</p>
                        <p class="text-muted">Assisted in frontend development using HTML, CSS, and jQuery. Maintained content management systems for various small business clients.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container text-center">
            <h2 class="h1 fw-bold mb-4">Let's Work Together</h2>
            <p class="lead text-muted mb-5">Ready to start your next project with a developer who understands your business needs?</p>
            <a href="{{ route('laravel') }}" class="btn btn-glow btn-lg px-5">Get In Touch</a>
        </div>
    </section>

    <footer class="text-center">
        <div class="container">
            <p class="mb-0 text-muted">&copy; 2026 Mohammad Almil Hisnullah. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
