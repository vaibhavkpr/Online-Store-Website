<!DOCTYPE html>
<html>

<style>
    h2{text-align: center;}
    h3{text-align: left;}
</style>

<center>
<head>
    <style type = "text/css">
        body{
            background-image:url(background.png);
            background-size:75%;
            background-attachment:fixed;
        }
    </style>
</head>


<body>
<br><br>

<div>
    <form>
    <label for = "find">Search Items: (Enter SKU) </label>
    <input type = "text" name = "find">
    <button type="submit" name="go"> Go </button>
    </form>        
    <br><br>
</div>

    <?php 
        
        if(isset($_POST['go'])){
            $find = (string)$_GET['find'];             

        if(!empty($find)){
            // Get json list of products from api
            $product_read_one_url = "http://localhost/phprest/api/product/read_one.php?SKU="+$find;
            $ch = curl_init($product_read_one_url);                                              
            curl_setopt($ch, CURLOPT_URL, $product_read_one_url);                               
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);            
            $result = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $obj = json_decode($result,true);
            curl_close($ch);

            if ($obj && !empty($obj)) {
            echo '<table>';

            // Headings for table
            echo '<span style="display: inline-block; width: 30px;">'."SKU".'</span>';
            echo '<span style="display: inline-block; width: 114px;">'."Type".'</span>';
            echo '<span style="display: inline-block; width: 80px;">'."Name".'</span>';
            echo '<span style="display: inline-block; width: 137px;">'."Description".'</span>';
            echo '<span style="display: inline-block; width: 120px;">'."Reg_Price".'</span>';
            echo '<span style="display: inline-block; width: 45px;">'."Sale_Price".'</span>';

            // List items from database
            
                foreach($obj as $result){
                echo '<tr>';
                    echo '<td>'.$result['SKU'].'</td>';
                    echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>';
                    echo '<td>'.$result['type'].'</td>';
                    echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>';
                    echo '<td>'.$result['name'].'</td>';
                    echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>';
                    echo '<td>'.$result['description'].'</td>';
                    echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>';
                    echo '<td>'.$result['regular_price'].'</td>';
                    echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>';
                    echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>';
                    echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; 
                    echo '<td>'.$result['sale_price'].'</td>';
                echo '</tr>';
                }
            }
            echo '</table>';
        }
    }
    
    ?>

    <!-- Label for products -->
    <div class = "container">
        <div class = "header">
            <h2> Available Items </h2>
        </div>
    </div>

    <?php
            // Get json list of products from api
            $product_read_url = "http://localhost/phprest/api/product/read.php";
            $ch = curl_init($product_read_url);                                              
            curl_setopt($ch, CURLOPT_URL, $product_read_url);                               
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);            
            $result = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $data = json_decode($result,true);
            curl_close($ch);

            $obj = $data['products'];   
  
            echo '<table>';
        
            // Headings for table
            echo '<span style="display: inline-block; width: 30px;">'."SKU".'</span>';
            echo '<span style="display: inline-block; width: 114px;">'."Type".'</span>';
            echo '<span style="display: inline-block; width: 80px;">'."Name".'</span>';
            echo '<span style="display: inline-block; width: 137px;">'."Description".'</span>';
            echo '<span style="display: inline-block; width: 120px;">'."Reg_Price".'</span>';
            echo '<span style="display: inline-block; width: 45px;">'."Sale_Price".'</span>';

            // List items from database
            if ($obj && !empty($obj)) {
                foreach($obj as $result){
                echo '<tr>';
                    echo '<td>'.$result['SKU'].'</td>';
                    echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>';
                    echo '<td>'.$result['type'].'</td>';
                    echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>';
                    echo '<td>'.$result['name'].'</td>';
                    echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>';
                    echo '<td>'.$result['description'].'</td>';
                    echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>';
                    echo '<td>'.$result['regular_price'].'</td>';
                    echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>';
                    echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>';
                    echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; echo '<td>' ."\t". '</td>'; 
                    echo '<td>'.$result['sale_price'].'</td>';
                echo '</tr>';
                }
            }
            echo '</table>';
    ?>

</body>
</center>
</html>