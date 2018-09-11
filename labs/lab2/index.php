<!DOCTYPE html>
<html>
    <head>
        <title> 777 Slot Machine </title>
    </head>
    <body>
        
        <?php
            
            $random_value = rand(0,2);
            
            if ($random_value == 0) {
                $symbol = "seven";
            } else if ($random_value == 1) {
                $symbol = "orange";
            } else {
                $symbol = "cherry";
            }
            
            $symbol = "seven";
            
            echo "<img src=\"img/$symbol.png\" alt='$symbol' title='".ucfirst($symbol)."'/>";
        
        ?>
        
    </body>
</html>