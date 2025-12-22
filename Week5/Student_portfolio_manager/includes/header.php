<!DOCTYPE html>
<html>
<head>
    <title>Student Portfolio Manager</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #eef2ff, #f8fafc);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== Header ===== */
        header {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: white;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 6px 18px rgba(0,0,0,0.15);
        }

        header h1 {
            margin: 0;
            font-weight: 600;
        }

        header p {
            
            margin-top: 8px;
            opacity: 0.9;
        }

        /* ===== Navigation ===== */
        nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            padding: 14px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        nav a {
            margin: 0 16px;
            text-decoration: none;
            color: #4f46e5;
            font-weight: 500;
            position: relative;
        }

        nav a::after {
            content: '';
            position: absolute;
            width: 0%;
            height: 2px;
            left: 0;
            bottom: -4px;
            background: #14b8a6;
            transition: width 0.3s;
        }

        nav a:hover::after {
            width: 100%;
        }

        /* ===== Main Container ===== */
        .container {
            background: white;
            width: 80%;
            max-width: 820px;
            margin: 50px auto;
            padding: 40px;
            border-radius: 18px;
            box-shadow: 0 20px 35px rgba(0,0,0,0.12);
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            text-align: center;
            color: #4f46e5;
            margin-bottom: 15px;
            font-weight: 600;
        }

        p {
            color: #475569;
            line-height: 1.6;
        }

        /* ===== Form Elements ===== */
        input, textarea {
            width: 100%;
            padding: 13px 15px;
            margin-top: 14px;
            border-radius: 10px;
            border: 1px solid #cbd5f5;
            font-size: 14px;
            outline: none;
            transition: all 0.3s;
        }

        input:focus, textarea:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
        }

        /* ===== Button ===== */
        button {
            width: 100%;
            padding: 14px;
            margin-top: 22px;
            background: linear-gradient(135deg, #14b8a6, #0d9488);
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 30px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 22px rgba(0,0,0,0.18);
        }

        /* ===== Footer ===== */
        footer {
            margin-top: auto;
            background: #4f46e5;
            color: white;
            text-align: center;
            padding: 14px;
            font-size: 14px;
        }

        .error {
            color: #dc2626;
            margin-top: 10px;
        }

        .success {
            color: #16a34a;
            margin-top: 10px;
        }

        /* ===== Responsive ===== */
        @media (max-width: 768px) {
            .container {
                width: 92%;
                padding: 30px;
            }

            nav a {
                display: inline-block;
                margin: 10px;
            }
        }
    </style>
</head>

<body>

<header>
    <h1>Student Portfolio Manager</h1>
    <p>Organize, manage, and showcase academic achievements</p>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="add_student.php">Add Student</a>
    <a href="upload.php">Upload Portfolio</a>
    <a href="students.php">View Students</a>
</nav>

<div class="container">
    <h2>Welcome</h2>
    <p style="text-align:center;">
        A simple and modern system to manage student profiles, documents,
        and portfolios efficiently.
    </p>
</div>

<!--
<footer>
    &copy; 2025 Student Portfolio Manager
</footer>
-->

</body>
</html>
