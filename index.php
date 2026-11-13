<?php
session_start();

$file = "counter.txt";

if (!isset($_SESSION['visited'])) {

    $count = (int)file_get_contents($file);
    $count++;

    file_put_contents($file, $count);

    $_SESSION['visited'] = true;
}

$visitors = file_get_contents($file);
?>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Sécuriser les include
$layout = __DIR__ . '/includes/layout.php';
$speakersFile = __DIR__ . '/includes/speakers-data.php';

if (!file_exists($layout)) {
    die('Erreur: layout.php manquant');
}
if (!file_exists($speakersFile)) {
    die('Erreur: speakers-data.php manquant');
}

require_once $layout;
require $speakersFile;

require_once 'includes/header.php';
render_header('home');
?>




<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAMS'2026: The Second National Conference Applied Mathematics Seminar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="icon" type="image/png" href="assets/images/logos/logoNAMS.jpg" />
    <meta name="description"
        content="NAMS' 2026 - The Second National Conference Applied Mathematics Seminar, University Of BISKRA, Algeria, 28-29 April 2027.">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        .highlight {
            color: orange;
            font-weight: bold;
        }

        /* Force remove all box styling on both pages */
        .committees-hierarchy .a-box,
        .committees-hierarchy .a-box-primary,
        .committees-grid .a-box {
            border: none !important;
            outline: none !important;
            border-radius: 0 !important;
            background: transparent !important;
            box-shadow: none !important;
            -webkit-box-shadow: none !important;
            -moz-box-shadow: none !important;
            padding: 0 !important;
            margin: 0 !important;
            min-height: auto !important;
        }

        .committees-hierarchy .a-box::before,
        .committees-hierarchy .a-box::after,
        .committees-hierarchy .a-box-primary::before,
        .committees-hierarchy .a-box-primary::after,
        .committees-grid .a-box::before,
        .committees-grid .a-box::after {
            display: none !important;
        }

        .hero-section {
            position: relative;
            background-image: url("assets/images/logos/background.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: scroll;
            /* effet parallax */
            padding: 100px 0;
            color: #fff;
        }

        /* Overlay sombre */
        .hero-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 50, 0.6);
            z-index: 1;
        }

        /* Contenu */
        .hero-grid {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        /* 👉 Titre pleine largeur */
        .hero-title {
            width: 100%;
            font-size: 48px;
            line-height: 1.2;
        }

        /* 👉 Ligne principale gauche / droite */
        .hero-info-row {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 40px;
            align-items: start;
        }

        /* 👉 Bloc gauche */
        .hero-location-block {
            max-width: 600px;
        }

        /* 👉 Countdown à droite */
        .deadline-card {
            max-width: 350px;
            margin-left: auto;
            text-align: center;
        }

        /* 👉 Responsive */
        @media (max-width: 768px) {
            .hero-info-row {
                grid-template-columns: 1fr;
            }

            .deadline-card {
                margin-left: 0;
                max-width: 100%;
            }

            .hero-title {
                font-size: 32px;
            }
        }

        /* ===== NAV (inchangé) ===== */
        .container {
            width: 90%;
            margin: auto;
        }

        .nav-menu {
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .nav-menu li {
            position: relative;
        }

        .nav-menu a {
            text-decoration: none;
            color: #1a2a44;
            font-size: 16px;
            font-weight: 500;
            transition: 0.3s;
        }

        .nav-menu a:hover {
            color: #0d6efd;
        }

        /* Dropdown */
        .dropdown-menu {
            position: absolute;
            top: 30px;
            left: 0;
            background: white;
            list-style: none;
            padding: 10px 0;
            display: none;
            min-width: 220px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .dropdown-menu li {
            padding: 8px 20px;
            text-align: center;
        }

        .dropdown-menu li a {
            color: #333;
            font-size: 14px;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        /* ===== Dates ===== */
        .dates-table {
            max-width: 800px;
            margin: 30px auto;
        }

        .date-row {
            display: grid;
            grid-template-columns: 320px 1fr;
            align-items: center;
            margin-bottom: 12px;
        }

        .date-label {
            font-weight: 700;
            color: #111;
        }

        .date-value {
            color: #222;
        }

        @media (max-width: 768px) {
            .date-row {
                grid-template-columns: 1fr;
                gap: 5px;
            }
        }
    </style>

    <style>
        /* Conteneur principal */
        .submission-stack {
            display: flex;
            flex-direction: column;
            gap: 30px;
            align-items: flex-start;
            /* 👉 force à gauche */
        }

        /* Cartes */
        .submission-card {
            width: 100%;
            text-align: justify;
            /* 👉 tout le texte à gauche */
        }

        /* Titres */
        .submission-card h3 {
            text-align: justify;
            margin-bottom: 15px;
            font-size: 25px;
        }

        /* Paragraphes */
        .submission-card p {
            text-align: justify;
            line-height: 1.6;
            font-size: 20px;

        }

        /* Listes */
        .submission-card ul {
            padding-left: 20px;
            /* 👉 indentation propre */
            text-align: justify;
        }

        .submission-card li {
            margin-bottom: 10px;
            line-height: 1.5;
            font-size: 20px;
        }

        /* Sous-titres */
        .submission-subheading {
            font-weight: 600;
            margin-top: 15px;
            text-align: justify;
            font-size: 25px;
        }

        /* Bouton */
        .submission-card .hero-cta {
            display: inline-block;
            margin-top: 15px;
        }
    </style>
 
    <style>
        .speakers-container {
            display: grid;
            grid-template-columns: repeat(10, 110px);
            /* 10 colonnes */
            gap: 25px;
            justify-content: center;
            max-width: 1400px;
            margin: 0 auto;
        }

        .speaker-card {
            width: 220px;
            grid-column: span 2;
        }

        /* Début de la 2ème ligne centré entre les 5 cards du haut */
        .speaker-card:nth-child(6) {
            grid-column: 2 / span 2;
        }

        .speaker-actions {
            text-align: center;
            margin-top: 15px;
        }

        @media (max-width: 1200px) {
            .speakers-container {
                grid-template-columns: repeat(4, 220px);
            }

            .speaker-card {
                grid-column: auto;
            }

            .speaker-card:nth-child(6) {
                grid-column: auto;
            }
        }

        @media (max-width: 992px) {
            .speakers-container {
                grid-template-columns: repeat(3, 220px);
            }
        }

        @media (max-width: 768px) {
            .speakers-container {
                grid-template-columns: repeat(2, 220px);
            }
        }

        @media (max-width: 576px) {
            .speakers-container {
                grid-template-columns: 220px;
            }
        }
    </style>

</head>


<body>

    <main>
        <section class="hero-section">
            <!-- <img src="assets/standard-quality-control-concept-m.jpg" alt="" data-aos="fade-in" class=""> -->

            <div class="hero-overlay"></div>
            <div class="container hero-grid">
                <div class="hero-content">
                    <h1 class="hero-title">THE SECOND
                        <span class="highlight">N</span>ATIONAL
                        <span class="highlight">A</span>PPLIED <br>
                        <span class="highlight">M</span>ATHEMATICS
                        <span class="highlight">S</span>EMINAR

                    </h1>
                    
                    <div class="hero-info-row">
                        <div class="hero-location-block">
                            <p class="hero-meta">
                                <span class="hero-meta-label">Location:</span>
                                Mohamed Khider University,<br> of BISKRA, Algeria
                            </p>
                            <br>
                            <a class="hero-cta" href="">
                                <i class="fas fa-pen-to-square"></i> Call For Paper
                            </a>


                        </div>


                        <aside class="deadline-card" aria-label="Conference countdown">
                            <h2><span class="highlight"> NAMS'26</span> will be held on November 22- 23, 2026</h2>
                            <div class="countdown-grid">
                                <div class="time-box">
                                    <span id="days">00</span>
                                    <small>Day</small>
                                </div>
                                <div class="time-box">
                                    <span id="hours">00</span>
                                    <small>Hour</small>
                                </div>
                                <div class="time-box">
                                    <span id="minutes">00</span>
                                    <small>Min</small>
                                </div>
                                <div class="time-box">
                                    <span id="seconds">00</span>
                                    <small>Sec</small>
                                </div>
                            </div>
                        </aside>
                    </div>


                </div>
            </div>
        </section>


        <section class="section section-soft" id="about">
            <div class="container">
                <div class="section-heading">
                    <!-- <p class="section-tag">About the conference
          </p> -->
                    <h2>About the conference NAMS'26</h2>
                </div>
            </div>
        </section>

        <section class="section section-soft" id="scope">
            <div class="container">
                <div class="section-heading">

                    <h2 style="text-align: left">Scope</h2>

                </div>

                <div class="text-card problem-card">
                    <p style=" text-align: justify">
                         The seminar will serve as a scientific forum for discussing different issues devoted to stochastic analysis, Statistics, Numerical analysis and other applied mathematics topics of current interest. The main goal of this scientific event is to exchange experiences and skills between different mathematics researchers and practitioners from different universities and institutions all across our country. We are proud to organize this seminar and look forward to welcoming you in Biskra.
                    </p>



                </div>
            </div>
        </section>

       

        <section class="section section-soft" id="tracks">
            <div class="container">
                <div class="section-heading">
                    <h2 style="text-align: left">Topics</h2>
                </div>

                <div class="accordion" style="font-size: 20px !important;">

                    <!-- Track 1 -->
                    <div class="accordion-item">
                        <button class="hero-cta" style="font-size: 20px !important;">
                          Probability theory
                        </button>
                       
                    </div>

                    <!-- Track 2 -->
                    <div class="accordion-item">
                        <button class="hero-cta" style="font-size: 20px !important;">
                         Optimal control and applications
                        </button>
                        
                    </div>

                    <!-- Track 3 -->
                    <div class="accordion-item">
                        <button class="hero-cta" style="font-size: 20px !important;">
                        stochastic analysis
                        </button>
                        
                    </div>

                    <!-- Track 4 -->
                    <div class="accordion-item">
                        <button class="hero-cta" style="font-size: 20px !important;">
                         Copula processes
                        </button>
                        
                    </div>

                    <!-- Track 5 -->
                    <div class="accordion-item">
                        <button class="hero-cta" style="font-size: 20px !important;">
                         Statistics of extremes
                        </button>
                       
                    </div>
                      <!-- Track 6 -->
                    <div class="accordion-item">
                        <button class="hero-cta" style="font-size: 20px !important;">
                          Empirical process theory
                        </button>
                       
                    </div>
                      <!-- Track 7 -->
                    <div class="accordion-item">
                        <button class="hero-cta" style="font-size: 20px !important;">
                          Numerical analysis and Simulations
                        </button>
                       
                    </div>
                     <!-- Track 8 -->
                    <div class="accordion-item">
                        <button class="hero-cta" style="font-size: 20px !important;">
                          PDE and Fractional calculus
                        </button>
                       
                    </div>
                    <!-- Track 9 -->
                    <div class="accordion-item">
                        <button class="hero-cta" style="font-size: 20px !important;">
                         Operator theory
                        </button>
                       
                    </div>
                    <!-- Track 10 -->
                    <div class="accordion-item">
                        <button class="hero-cta" style="font-size: 20px !important;">
                         Artificial intelligence
                        </button>
                       
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="conference-objectives">
            <div class="container">
                <div class="section-heading">
                    <!-- <p class="section-tag">conference-objectives</p> -->
                    <h2 style="text-align: left">Conference Objectives</h2>
                </div>


                <div class="container">

                    <div class="text-card problem-card">
                        <p style=" text-align: justify">
                             Provide a scientific forum for researchers, academics, and practitioners to present and discuss recent developments, innovative ideas, and current challenges in stochastic analysis, statistics, numerical analysis, and other areas of applied mathematics. </p>
                    </div>
                </div>
                <br>
                <div class="container">


                    <div class="text-card problem-card">
                        <p style=" text-align: justify">
                            Foster interactions between researchers working in different mathematical fields and related scientific disciplines, encouraging the exchange of knowledge and interdisciplinary research.
                        </p>
                    </div>
                </div>
                <br>
                <div class="container">


                    <div class="text-card problem-card">
                        <p style=" text-align: justify">
                            Offer participants an opportunity to showcase their ongoing research, discuss their scientific contributions, and explore new mathematical approaches to solving theoretical and practical problems.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-soft" id="outcomes">
            <div class="container">
                <div class="section-heading">
                    <!-- <h1 class="section-tag"> Expected Outcomes</h1> -->
                    <h2 style="text-align: left">Expected Outcomes</h2>
                    <!-- <h2>What NAMS 2026 aims to deliver</h2> -->
                </div>

                <div class="info-grid outcomes-grid" style="margin: 0 auto;">
                    <article class="info-card">
                        <h3><span class="track-index">01</span></h3>
                        <p style=" text-align: justify">Share recent research findings, scientific contributions, and innovative approaches in stochastic analysis, statistics, numerical analysis, and other areas of applied mathematics.</p>
                    </article>
                    <article class="info-card">
                        <h3><span class="track-index">02</span></h3>
                        <p style=" text-align: justify">Establish new research connections and encourage collaborative projects between researchers, universities, research laboratories, and academic institutions.</p>
                    </article>
                    <article class="info-card">
                        <h3><span class="track-index">03</span></h3>
                        <p style=" text-align: justify">Identify emerging challenges, open mathematical problems, and promising research perspectives that could lead to future scientific investigations.</p>
                    </article>
                    <article class="info-card">
                        <h3><span class="track-index">04</span></h3>
                        <p style=" text-align: justify">Encourage the integration of mathematical methods and techniques into other scientific disciplines, highlighting their role in addressing complex real-world problems.</p>
                    </article>
                    <article class="info-card">
                        <h3><span class="track-index">05</span></h3>
                        <p style=" text-align: justify">Provide doctoral students and early-career researchers with opportunities to present their work, receive constructive feedback, improve their scientific communication skills, and interact with experienced academics.</p>
                    </article>
                    <article class="info-card">
                        <h3><span class="track-index">06</span></h3>
                        <p style=" text-align: justify">Facilitate the sharing of successful research methodologies, numerical tools, statistical techniques, and practical experiences among participants.</p>
                    </article>
                    <article class="info-card">
                        <h3><span class="track-index">07</span></h3>
                        <p style=" text-align: justify">Develop lasting scientific relationships that may lead to joint publications, research projects, academic exchanges, and future scientific events.</p>
                    </article>
                </div>
            </div>
        </section>


        <section class="section" id="important-dates">
            <div class="container">
                <div class="section-heading">
                    <h2 style="text-align: left">Important Dates</h2>
                </div>

                <div class="dates-list">
                    <div class="date-item">
                        <span class="date-label">Submission Deadline:</span>
                        <span class="date-value">
                            <del style="color: red;">
                                October 30, 2026
                            </del>  &nbsp; November 10, 2026</span>
                    </div>

                    <div class="date-item">
                        <span class="date-label">Acceptance Notification:</span>
                        <span class="date-value">November 16, 2026</span>
                    </div>

                 
                    <div class="date-item">
                        <span class="date-label">Conference:</span>
                        <span class="date-value">November 22-23, 2026</span>
                    </div>
                </div>
        </section>




        <section class="section section-soft" id="Chairs">
            <div class="container">
                <div class="committee-layout">
                    <div class="section-heading">
                        <!-- <p class="section-tag">Conference Leadership</p> -->
                        <h2> Committees Chairs </h2>
                    </div>
                    <div class="committee-feature">
                        <h3 style="color: #d7b24b !important;">Honorary Chairs</h3>
                        <ul>
                            <li>
                                <p class="name"><a href="#" target="_blank">Pr. Zohir DIBI</a></p>
                                <p class="affiliation">Rector of University of Biskra, Algeria</p>
                            </li>
                            <li>
                                <p class="name"><a href="#" target="_blank">Pr. Abdallah ATTAF</a></p>
                                <p class="affiliation"> Dean of the Faculty of Exact Sciences, University of Biskra, Algeria</p>
                            </li>
                            <li>
                                <p class="name"><a href="#" target="_blank">Pr. Shahjahan Khan</a></p>
                                <p class="affiliation"> Editor in Chief (JAPS), Asian University of Bangladesh</p>
                            </li>
                             </ul>
                             <br>
                            <h3 style="color: #d7b24b !important;">President of the Seminar</h3>
                         <ul>
                            <li>
                                <p class="name"><a href="#" target="_blank">Pr. Adel CHALA </a></p>
                                <p class="affiliation">University of Biskra, Algeria</p>
                            </li>
                         </ul>
                         <br>
                         <h3 style="color: #d7b24b !important;">President of the Scientific Committee</h3>
                         <ul>
                            <li>
                                <p class="name"><a href="#" target="_blank">Pr.  Nabil KHELFALLAH </a></p>
                                <p class="affiliation">University of Biskra, Algeria</p>
                            </li>
                         </ul>
                         <br>
                         <h3 style="color: #d7b24b !important;">President of the Scientific Committee</h3>
                         <ul>
                              <li>
                                <p class="name"><a href="#" target="_blank">Dr.   Abdelhak GHOUL </a></p>
                                <p class="affiliation"> University of Biskra, Algeria</p>
                            </li>
                            </ul>
                       
                    </div>

                    <div class="committees-hierarchy" id="committees">
                        <!-- All 3 committees at the same level -->
                        <div class="hierarchy-level-1">
                            <div class="a-box">
                                <h4> </h4>
                                <h4> </h4>
                                <h4></h4>
                                <h4></h4>
                                <h3 style="color: #d7b24b !important;">Scientific committee </h3>
                                <ul>
                                    <li>
                                        <p class="name">Pr. Nabil Khelfallah</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                    <li>
                                        <p class="name">Pr.  Adel Chala</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                    <li>
                                        <p class="name">Pr. Mokhtar Hafayed</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                    <li>
                                        <p class="name">Pr. Abdelhakim Necir</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                     <li>
                                        <p class="name">Pr. Mezerdi Brahim</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                    <li>
                                        <p class="name">Pr. Laiadi Abdelkadeur</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                    <li>
                                        <p class="name">Pr.  Zouhir Mokhtari</p>
                                        <p class="affiliation">University of Batna 2, Algeria</p>
                                    </li>
                                     <li>
                                        <p class="name">Pr. Abdellaoui Boumediene</p>
                                        <p class="affiliation">University of Tlemcen, Algeria</p>
                                    </li>
                                    <li>
                                        <p class="name">Pr. Mohamed Berbiche</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                     
                                     <li>
                                        <p class="name">Pr. Touaoula Tarik</p>
                                        <p class="affiliation">University of Tlemcen, Algeria</p>
                                    </li>
                                     
                                     <li>
                                        <p class="name">Pr. Brahim Brahimi</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                     <li>
                                        <p class="name">Pr. Khaled Melkemi</p>
                                        <p class="affiliation">University of Batna 2, Algeria</p>
                                    </li>
                                     <li>
                                        <p class="name">Pr.  Salah Eddine Rebiai</p>
                                        <p class="affiliation">University of Batna 2, Algeria</p>
                                    </li>
                                    <li>
                                        <p class="name">Pr.  Salah Eddine Rebiai</p>
                                        <p class="affiliation">University of Batna 2, Algeria</p>
                                    </li>
                                     
                                    <li>
                                        <p class="name">Pr.  Gherbal Boulakhras</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                    <li>
                                        <p class="name">Pr. Hamaizia Tayeb</p>
                                        <p class="affiliation">University of Oum El Bouaki, Algeria</p>
                                    </li>
                                    <li>
                                        <p class="name">Pr. Imad Eddine Lakhdari</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                     <li>
                                        <p class="name">Dr. Boubakeur Labed</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                     <li>
                                        <p class="name">Dr. Rahmani Nacer</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                    <li>
                                        <p class="name">Pr.  Menacer Tidjani</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                    <li>
                                        <p class="name">Pr. Fazia Bedouhene</p>
                                        <p class="affiliation">University of Tizi Ouzou, Algeria</p>
                                    </li>
                                </ul>
                            </div>

                        

                            <div class="a-box" id="committees2">
                                <h4> </h4>
                                <h4> </h4>
                                <h4></h4>
                                <h4></h4>

                                <h3 style="color: #d7b24b !important;"> Organization Committee</h3>
                                <ul>
                                    <li>
                                        <p class="name">Dr. Abdelhak Ghoul</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                     <li>
                                        <p class="name">Pr. Lakhdari Imad Eddine</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                     <li>
                                        <p class="name">Pr. Djabrane Yahia</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                     <li>
                                        <p class="name">Pr. Adel Chala</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                     <li>
                                        <p class="name">Pr. Brahim Brahimi</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                    <li>
                                        <p class="name">Dr. Boubakeur Labed</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                    <li>
                                        <p class="name"> Pr. Mokhtar Hafayed</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                    <li>
                                        <p class="name">Pr. Nabil Khalfallah</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                   
                                    <li>
                                        <p class="name">Dr. Hafayed Dahbia</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                    <li>
                                        <p class="name">Dr. Hamed Ikram</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li> 
                                     <li>
                                        <p class="name">Dr. Abdelhadi Khaoula</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                    <li>
                                        <p class="name"> Dr. Korichi Fatiha</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                    <li>
                                        <p class="name">Dr. Ninouh Abdelhakim</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                    <li>
                                        <p class="name"> Pr. Brahimi Brahim</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                     <li>
                                        <p class="name"> Dr. Tamer Lazhar</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                     <li>
                                        <p class="name"> Dr. Labed Salwa</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                     <li>
                                        <p class="name"> Dr. Hamdi Soumia</p>
                                        <p class="affiliation">University of Biskra, Algeria</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <br><br>

           
        </section>


        <section class="section" id="Speakers">
            <div class="container">
                <div class="section-heading">

                    <h2> Speakers</h2>
                </div>


                <div class="speakers-container">
                    <?php foreach ($speakers as $speaker): ?>
                        <div class="speaker-card">
                            <img src="<?= htmlspecialchars($speaker['image'], ENT_QUOTES, 'UTF-8') ?>" class="speaker-img" alt="<?= htmlspecialchars($speaker['name'], ENT_QUOTES, 'UTF-8') ?>">
                            <h3><?= htmlspecialchars($speaker['name'], ENT_QUOTES, 'UTF-8') ?> </h3>
                            <p class="university"><?= htmlspecialchars($speaker['title'], ENT_QUOTES, 'UTF-8') ?></p>

                           
                            
                            
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </section>



        <section class="section section-soft" id="submission">
            <div class="container">
                <div class="section-heading">
                    <h2 style="text-align:left">Submission</h2>
                </div>

                <div class="submission-accordion">

                    <!-- 1 -->
                    <article class="submission-card" id="paper-guidelines">
                        <button class="submission-header">1. Paper Guidelines</button>
                        <div class="submission-content">
                            <ul>

                                <li> <strong> Submitted papers must:</strong>

                                    <ul>
                                        <li> Present original and unpublished research not under review elsewhere</li>
                                        <li> Clearly define the research problem, objective, and contribution </li>
                                        <li> Be written in clear academic English </li>
                                    </ul>
                                </li>

                                <li> <strong>Manuscript Preparation:</strong>

                                    <ul>
                                        <li> Papers must be submitted in PDF formats. </li>
                                        <li> Papers should be between 4 and 8 pages in length </li>
                                        <li> Authors must use the official conference template </li>
                                    </ul>
                                </li>
                               

                            </ul>
                        </div>
                    </article>
                    <!-- 2 -->
                    <article class="submission-card" id="Templates">
                        <button class="submission-header">2. Templates</button>
                        <div class="submission-content">

                            <p>
                                This
                                conference is a double-blind peer-reviewed conference. You need to submit an <strong>Article File, including</strong>:
                            </p>
                            <ul>
                                <li>Title. </li>
                                <li> Abstract .</li>
                                <li> Introduction.</li>
                                <li> Literature Review.</li>
                                <li> Methodology/Approach.</li>
                                <li> Findings/Results.</li>
                                <li> Conclusion/Implications/Recommendations.</li>
                                <li> References .</li>
                                <li> Appendices (when appropriate).</li>
                            </ul>
                            <p>
                                Download the official manuscript template
                                <a href="assets/files/Template 2ndNAMS2026.tex"
                                    target="_blank"
                                    style="color: red; font-weight:bold;">
                                    here
                                </a>.
                            </p>


                        </div>
                    </article>

                    <!-- 3 -->
                    <article class="submission-card" id="where-to-submit">
                        <button class="submission-header">3. Where to Submit</button>
                        <div class="submission-content">
                            <p>
                                Authors are invited to submit their papers through the following email: <span style="color: red; font-weight:bold;">
                                    nams2026@univ-biskra.dz
                    </span>. </p>
                             
                           
                        </div>
                    </article>

                    <!-- 4 -->
                   

                    <!-- 5 -->
                    
                </div>
            </div>
         
        </section>

        <section class="section" id="publication">
            <div class="container">

                <div class="section-heading">
                    <h2 style="text-align: center">
                        Publication and Indexing opportunities
                    </h2>
                </div>

                <!-- FIRST CARD -->
                <div class="container">
                    <div class="text-card problem-card">
                        <p style="text-align: justify">
                            All accepted papers will be considered for publication in the conference proceedings.
                            Detailed information regarding publication arrangements will be updated in due course.
                        </p>
                    </div>
                </div>

                <br>

                <!-- SECOND CARD -->
                <div class="container">
                    <div class="text-card problem-card">




                        <!-- TEXT -->
                        <p style="text-align: justify">
                            Selected high-quality papers will be invited to submit substantially extended versions for possible publication in the following journals, which are indexed in <span style="color: red !important; font-weight: bold !important;">
    Scopus, Mathematical Reviews, MathSciNet, Zentralblatt für Mathematik, and Google Scholar
                    </span>:
                        </p>

                       
                            <div class="publication-logos">

                                <a target="_blank" href="https://japs.isoss.net/AuthorsInstructions.htm">
                                    <img src="assets/images/logos/Revue_JAPS.jpg" alt="Scopus">
                                </a>

                                <a target="_blank" href="https://journals.univ-biskra.dz/index.php/ijams">
                                    <img src="assets/images/logos/JAMAS.png" style="height: 100px;" alt="Scopus">
                                </a>
                                <a target="_blank">
                                    <img src="assets/images/logos/scopus.png" style="height: 100px;" alt="Scopus">
                                </a>

                            </div>

                            
                    </div>
                </div>

                <br>

            </div>
        </section>



        <section class="section section-soft" id="Sponsors">
            <div class="container">
                <div class="section-heading">
                  
                        
                    <h2>Sponsors</h2>
             <div class="speakers-container">
            <div class="speaker-card">
                 <img src="assets/images/logos/Laboratoire AMPO.jpg" alt="LAMPO">
                 
            </div>
            <div class="speaker-card">
                 <img src="assets/images/logos/Laboratoire Math_Appliquées.png" alt="LMA">
            </div>
             <div class="speaker-card">
                 <img src="assets/images/logos/Logo_faculty.png" alt="LMA">
            </div>
                </div>
           </div>


               
            </div>
        </section>



    </main>

    <div id="contact">

        <?php
        // echo "Compteur = ".$visitors;
        render_site_footer(); ?>
    </div>
    



    <script src="assets/js/script.js"></script>

    <script>
        const items = document.querySelectorAll(".accordion-item");

        items.forEach(item => {
            const header = item.querySelector(".accordion-header");
            const content = item.querySelector(".accordion-content");

            header.addEventListener("click", () => {
                const isActive = item.classList.contains("active");

                // fermer tous
                items.forEach(i => {
                    i.classList.remove("active");
                    i.querySelector(".accordion-content").style.maxHeight = null;
                });

                // ouvrir si fermé
                if (!isActive) {
                    item.classList.add("active");
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
        });
    </script>

    <script>
        document.querySelectorAll(".submission-header").forEach(button => {
            button.addEventListener("click", () => {
                const card = button.parentElement;

                // Fermer les autres (option premium)
                document.querySelectorAll(".submission-card").forEach(item => {
                    if (item !== card) {
                        item.classList.remove("active");
                    }
                });

                // Toggle actif
                card.classList.toggle("active");
            });
        });
    </script>



    <script>
        function goToBio(speakerId) {
            window.location.href = "speakers.php?speaker=" + speakerId;
        }
    </script>

    <?php include 'includes/footer.php'; ?>

</body>

</html>