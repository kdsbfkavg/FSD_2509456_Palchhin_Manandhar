<html>
<body>
    <style>
        .header{
        display: flex;
        justify-content: space-between;
        background-color: #f2f2f2;
        padding: 20px;
        }

        nav{
            display: flex;
            gap: 50px;
        }

        .navigation a{
            padding: 10px;
            border-radius: 10px;
            text-decoration: none;
            color: inherit;
            transition: 0.3s;
        }

        .navigation a:hover{
            background-color:  #ddd;
        }


    </style>

    <div class = "header">
    <h3> Rajin Maharjan </h3>
    <nav>
        <p class = "navigation"><a href = "index.php" > home </a></P>
        <P class = "navigation"><a href = "add_student.php"> add student </a></p>
        <p class = "navigation"><a href = "upload.php"> upload file </a></p>
        <p class = "navigation"><a href = "students.php" >student info </a></P>
    </nav>
    </div>
</body>
</html>