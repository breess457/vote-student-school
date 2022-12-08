<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    include('../public/link.php');
    session_start();
    session_destroy();
    echo "
        <script>
            Swal.fire({
               icon:\"success\",
               title:\"Logout to Successs\",
               text:'ออกจากระบบ เรียบร้อย',
               confirmButtonText:\"OK\"
           }).then((result)=>{
              if (result.value) {
                window.location ='../index.php'
              }
           })
        </script>
    ";

    ?>
</body>

</html>