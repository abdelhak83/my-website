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
require_once __DIR__ . '/includes/layout.php';
require __DIR__ . '/includes/speakers-data.php';
require_once 'includes/header.php';
render_header('speakers');
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
        content="NAMS'2026 - The Second National Conference Applied Mathematics Seminar, University Of BISKRA, Algeria, 28-29 April 2027.">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        .highlight {
            color: orange;
            font-weight: bold;
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
        }

        /* Paragraphes */
        .submission-card p {
            text-align: justify;
            line-height: 1.6;
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
        }

        /* Sous-titres */
        .submission-subheading {
            font-weight: 600;
            margin-top: 15px;
            text-align: justify;
        }

        /* Bouton */
        .submission-card .hero-cta {
            display: inline-block;
            margin-top: 15px;
        }
    </style>
</head>


<body>


    <main>
        <section class="page-banner">
            <div class="container">
                <h1>Speakers</h1>
            </div>
        </section>

        <section class="speakers-page">
            <div class="container speakers-list">
                <?php foreach ($speakers as $speaker): ?>
                    <article class="speaker-feature" id="<?= htmlspecialchars($speaker['slug'], ENT_QUOTES, 'UTF-8') ?>">
                        <div>
                            <img
                                class="speaker-photo"
                                src="<?= htmlspecialchars($speaker['image'], ENT_QUOTES, 'UTF-8') ?>"
                                alt="<?= htmlspecialchars($speaker['name'], ENT_QUOTES, 'UTF-8') ?>">
                        </div>

                        <div class="speaker-copy">
                            <h2><?= htmlspecialchars($speaker['name'], ENT_QUOTES, 'UTF-8') ?></h2>
                            <p class="speaker-role"><?= htmlspecialchars($speaker['title'], ENT_QUOTES, 'UTF-8') ?></p>
                            <br>
                            <p class="speaker-bio">
                                <?= (htmlspecialchars($speaker['bio'], ENT_QUOTES, 'UTF-8')) ?>
                            </p>

                            <?php if (!empty($speaker['links'])): ?>
                                <div class="social-icons">
                                    <?php foreach ($speaker['links'] as $link): ?>
                                        <a href="<?= htmlspecialchars($link['url'], ENT_QUOTES, 'UTF-8') ?>"
                                            target="_blank"
                                            class="btn-icon <?= strtolower($link['label']) ?>"
                                            title="<?= htmlspecialchars($link['label'], ENT_QUOTES, 'UTF-8') ?>">

                                            <i class="<?= get_icon_class($link['label']) ?>"></i>

                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>


        </section>
    </main>

    <?php render_site_footer(); ?>
    <script src="assets/js/script.js"></script>
    <script>
        const speakerMap = {
            Abdelhakim : " Abdelhakim-Necir",
            Mezerdi : " Mezerdi-Brahim",
            Tarik: " Touaoula-Tarik",
            Rebiai: " Salah-Eddine-Rebiai",
            Fazia : " Fazia-Bedouhene",
            Ahmed: " Ahmed-Medeghri"
           
        };

        const params = new URLSearchParams(window.location.search);
        const speakerKey = params.get("speaker");

        if (speakerKey && speakerMap[speakerKey]) {
            const target = document.getElementById(speakerMap[speakerKey]);
            if (target) {
                window.setTimeout(() => {
                    target.scrollIntoView({
                        behavior: "smooth",
                        block: "start"
                    });
                }, 120);
            }
        }
    </script>
    <?php include 'includes/footer.php'; ?>

</body>

</html>