<?php
 include "includes/header.php"; 
?>

<html>
    <head>
        <title>My PHP Page</title>
    </head>

    <body>
        <style>
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            html,body{
                height: 100%;
            }

            body {
                display: flex;
                flex-direction: column;
            }

            .container{
                flex: 1;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .container div {
                background-color: #f2f2f2;
                padding: 20px;
                border-radius: 10px;
                width: 300px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            }

            .info{
                border: 1px solid black;
                margin-top: 10px;
                padding: 10px;
                border-radius: 10px;
                transition: 0.3s;
            }

            .info a{
                text-decoration: none;
                color: inherit;
            }

            .info:hover{
                background-color: #ddd;
                cursor: pointer;
                transform: scale(1.04);
            }
        </style>

        <div class = "container">
        <div>
            <h3 style = "text-align: center; "> Welcome User</h3><br>
            <p  class = "info"><a href = "add_student.php"> ADD STUDENT</a></p><br>
            <p class = "info"><a href = "upload.php" > UPLOAD FILE </a></p><br>
            <p class = "info"><a href ="students.php" > STUDENT INFO </a></p><br>
        </div> 
        </div>

    </body>
</html>

<?php
    include "includes/footer.php";
?>