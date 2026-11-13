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
require_once 'includes/header.php';
render_header('committees');
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
        content="NAMS 2026 - The Second National Conference Applied Mathematics Seminar, University Of BISKRA, Algeria, 28-29 April 2027.">
    <link rel="stylesheet" href="assets/css/styles.css">


    <style>
        /* SECTION */
        #registration-Fees {
            padding: 80px 0;
            background: #f7f7f7;
        }

        /* TITLE */
        #registration-Fees .section-heading {
            text-align: center;
            margin-bottom: 50px;
        }

        #registration-Fees .section-heading h2 {
            font-size: 48px;
            font-weight: 800;
            color: #111;
            position: relative;
            display: inline-block;
        }

        #registration-Fees .section-heading h2::after {
            content: "";
            width: 90px;
            height: 4px;
            /* background: #ff2d75; */
            position: absolute;
            left: 50%;
            bottom: -18px;
            transform: translateX(-50%);
            border-radius: 20px;
        }

        /* TABLE CONTAINER */
        .registration-table-container {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }

        /* TABLE STYLE */
        .registration-table {
            width: 100%;
            max-width: 900px;
            border-collapse: separate;
            border-spacing: 0 20px;
        }

        /* HEAD */
        .registration-table thead th {
            background: #ffffff;
            color: #111;
            font-size: 22px;
            font-weight: 700;
            padding: 22px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.06);
        }

        /* BODY ROWS */
        .registration-table tbody tr {
            background: #eac094;
            transition: 0.3s ease;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.06);
        }

        .registration-table tbody tr:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        /* CELLS */
        .registration-table tbody td {
            padding: 28px 20px;
            text-align: center;
            font-size: 22px;
            color: #222;
        }

        /* CATEGORY */
        .registration-table tbody td:first-child {
            font-weight: 700;
        }

        /* PRICE */
        .registration-table tbody td:last-child {
            font-size: 34px;
            font-weight: 800;
            color: #111;
        }

        /* ROUNDED CORNERS */
        .registration-table thead th:first-child,
        .registration-table tbody td:first-child {
            border-top-left-radius: 14px;
            border-bottom-left-radius: 14px;
        }

        .registration-table thead th:last-child,
        .registration-table tbody td:last-child {
            border-top-right-radius: 14px;
            border-bottom-right-radius: 14px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {

            .registration-table thead {
                display: none;
            }

            .registration-table,
            .registration-table tbody,
            .registration-table tr,
            .registration-table td {
                display: block;
                width: 100%;
            }

            .registration-table tr {
                margin-bottom: 20px;
                border-radius: 14px;
                overflow: hidden;
            }

            .registration-table td {
                text-align: center;
                padding: 18px;
            }

            .registration-table td:last-child {
                font-size: 28px;
            }
        }
    </style>
</head>


<body>


    <main>
        <section class="page-banner">
            <div class="container">
                <h1>Program</h1>
            </div>
        </section>




        
        
        <section class="section" id="organization">
            <div class="container">
              
                <p class="submission-note" style="font-size: 20px;">Details will be provided soon</p>
            </div>
            </div>
        </section>

    </main>
    <?php render_site_footer(); ?>
    <script src="assets/js/script.js"></script>
    <?php include 'includes/footer.php'; ?>

</body>

</html>