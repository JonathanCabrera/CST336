<?php
    session_start();

    include 'inc/dbConnection.php';
    $dbConn = startConnection("final");
    include 'inc/functions.php';

    function filterChampions() {
        global $dbConn;
        
        $champId = $_GET['champId'];
        $namedParameters = array();
      
        $sql = "SELECT * FROM champions
                INNER JOIN abilities ON champions.champId = abilities.champId
                INNER JOIN stats ON champions.champId = stats.champId WHERE 1";
                
        if (!empty($_GET['championName'])) {
            $name = $_GET['championName'];
            $sql .= " AND champName LIKE '%$name%'";
            }
                
        if ($_GET['rolePicker'] != "") {
            $role = $_GET['rolePicker'];
            $sql .= " AND role = '$role'";
            
        }
        
        if ($_GET['tierPicker'] != "") {
            $rank = $_GET['tierPicker'];
            $sql .= " AND tierRank = '$rank'";
            
        }
        
        if ($_GET['gender'] == "male") {
            $sql .= " AND Gender = 'M'";
        } else if ($_GET['gender'] == "female") {
            $sql .= " AND Gender = 'F'";
        }
        
        
        if (isset($_GET['orderBy'])) {
            if ($_GET['orderBy'] == "tier") {
                $sql .= " ORDER BY TierRank ASC";
            } else if ($_GET['orderBy'] == "role") {
                $sql .= " ORDER BY role ASC";
            }
        }
    
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);  
        
        echo "<table class='table'>";
        echo '<tr>';
            echo "  <td><h4>Role</h4></td>";
            echo "  <td id='v1'></td>";

            echo "  <td><h4>Tier</h4></td>";
            echo "  <td id='v1'></td>";

            echo "  <td><h4></h4></td>";
            echo "  <td><h4>Champion<h4></td>";
            echo "  <td><h4></h4></td>";
            echo "  <td id='v1'></td>";
            echo "  <td><h4>Ultimate</h4></td>";
            echo "  <td><h4></h4></td>";
            echo "  <td><h4></h4></td>";
            echo "  <td id='v1'></td>";
            echo "  <td><h4>Gender</h4></td>";
            echo '</tr>';
    
        foreach ($records as $record) {
            if ($record)
            $champId = $record['champId'];
            
            $champName = $record['champName'];
            $champDes = $record['champDes'];
            $image = $record['image'];
            $gender = $record['Gender'];
            
            $ultimateName = $record['ultimateName'];
            $ultimateDes = $record['ultimateDes'];
            $ultimateImage = $record['ultimateImage'];
            
            $role = $record['role'];
            $tier = $record['tierRank'];
        
            echo '<tr>';
            echo "  <td><h4>$role</h4></td>";
            echo "  <td id='v1'></td>";

            echo "  <td><h4>$tier</h4></td>";
            echo "  <td id='v1'></td>";

            echo "  <td><h4>$champName</h4></td>";
            echo "  <td><img src='img/champions/$image'></td>";
            echo "  <td><h4>$champDes</h4></td>";
            echo "  <td id='v1'></td>";
            echo "  <td><h4>$ultimateName</h4></td>";
            echo "  <td><img src='img/ultimates/$ultimateImage'></td>";
            echo "  <td><h4>$ultimateDes</h4></td>";
            echo "  <td id='v1'></td>";

            echo "  <td><h4>$gender</h4></td>";
            echo '</tr>';
        }
        echo "</table>";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>League of Legends Search</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    
    <body>
        <!-- Bootstrap Navagation Bar -->
            <nav class='navbar navbar-default - navbar-fixed-top'>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                    </div>
                    <ul class='nav navbar-nav'>
                        <!--<li><a href='index.php'>Home</a></li>-->
                        <li><a href = 'adminPage.php'>Admin</a></li>
                    </ul>
                </div>
            </nav>
        <br>
        <br>
        
        <h1>League of Legends Search</h1>
        <div id="tableDiv">
            <form>
                <table>
                    <tbody>
                        <tr>
                            <b>Champion Name: </b>
                            <input type="text" name="championName"/>
                            <br><br>
                        </tr>
                        
                        <tr>
                            <td>
                                <b>Role:</b> 
                                <select name="rolePicker">
                                  <option value="">All Roles</option>
                                  <option value="Top">Top</option>
                                  <option value="Jungle">Jungle</option>
                                  <option value="Middle">Middle</option>
                                  <option value="ADC">ADC</option>
                                  <option value="Support">Support</option>
                                </select> 
                                </br></br>
                            </td>
                            
                            <td>
                                <b>Tier:</b> 
                                 <select name="tierPicker">
                                    <option value="">All Tiers</option>
                                    <option value="S">S</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                </select>
                                </br></br>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <b>Select Gender:</b>
                                <br>
                                <input type="radio" name="gender" value="male"> Male<br>
                                <input type="radio" name="gender" value="female"> Female<br>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <b>Order By:</b>
                                <br>
                                <input type="radio" name="orderBy" value="tier"> Tier<br>
                                <input type="radio" name="orderBy" value="role"> Role<br>
                                </br></br>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <input type="submit" name="submitx" value="Search"/>
            </form>
        </div> 
        <br><br>
        
        <hr>
        <?php
            if($_GET['submitx'] == 'Search') {
                echo "<h2> Results: </h2>";
                filterChampions();
            }
        ?>
        <hr>
      
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>   
    </body>
</html>
