<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convarter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>



<div class="main">

<div class="unicode1">
    <div>
        <textarea rows="4" cols="50" name="uni1_val" id="uni1_val">
            At w3schools.com you will learn how to make a website. We offer free tutorials in all web development technologies.
        </textarea>
    </div>
    <div class="convart_btn">
        <button>Clear</button>
        <button onclick="myfunction()">Convart</button>    
    </div>
</div>
<div>
    <textarea rows="4" cols="50">
        At w3schools.com you will learn how to make a website. We offer free tutorials in all web development technologies.
    </textarea>
</div>


</div>

</body>
</html>

<?php 

require_once __DIR__.'/src/Unicode2Bijoy.php';


?>



<script>

function myfunction(){
    var uni1_val = document.getElementById('uni1_val').value;
    console.log(uni1_val);
    

    var bijoy_result = "<?php echo mirazmac\Unicode2Bijoy::convert($str) ?>";
   console.log(bijoy_result);
   

}

</script>