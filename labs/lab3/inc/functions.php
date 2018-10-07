<?php
$deck = array();
$suits = array("hearts", "clubs", "diamonds", "spades");
$hearts = array();
$clubs = array();
$diamonds = array();
$spades = array();
$players = array();
$winners = array();
$playersArray = array("Bulbasur","Darkrai","Dragonite","Ghastly");
session_start();

    function displayPlayer() {
        global $playersArray;
        shuffle($playersArray);
        echo "<hr>";
        foreach($playersArray as $value) {
            echo "<table id='playerTable'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th><img src= 'img/player/$value.png' alt= '$value' title= '$value' width= '65px'/> </th> ";
                echo "<center>$value</center>";
                echo "</tr>";
                echo "</thead>";
                echo "</table>";
        }
        echo "<hr>";
    }

    function setDeck(){ //Sets the Deck of cards.
        global $hearts, $spades, $diamonds, $clubs;
        
        for($i = 1; $i <= 13; $i++) {
            $hearts[] = $i;
            $clubs[] = $i;
            $diamonds[] = $i;
            $spades[] = $i;
            
        }
    }
    
    function draw() {//draw cards until total is <= 42
        global $suits, $hearts, $spades, $diamonds, $clubs, $playersArray;
        
        shuffle($hearts);
        shuffle($spades);
        shuffle($diamonds);
        shuffle($clubs);
        shuffle($playersArray);
        
        $total = 0;
        $i = 0;
        
        echo "<div>";
        
        while ($total < 42) {
            
            if ((43 - $total) <= 7) { //allows total to go over 42, but not by an absurd amount
                break;
            }
            
            $randomSuit = array_rand($suits);
            switch ($randomSuit) { //used to choose card from correct img folder
                case 0: $suit = "hearts";
                    break;
                case 1: $suit = "clubs";
                    break;
                case 2: $suit = "diamonds";
                    break;
                case 3: $suit = "spades";
                    break;
                default:
                    break;
            }
            
            if ($suit == "hearts") {
                $card = $hearts[0];
                array_shift($hearts);
                $total += $card;
            } 
            else if ($suit == "clubs") {
                $card = $clubs[0];
                array_shift($clubs);
                $total += $card;
            }
            else if ($suit == "diamonds") {
                $card = $diamonds[0];
                array_shift($diamonds);
                $total += $card;
            } else {
                $card = $spades[0];
                array_shift($spades);
                $total += $card;
            }
            
            
            echo "<img src= 'img/cards/$suit/$card.png' alt= '$suit/$card' title= '$suit/$card' width= '60px'/>";
            //echo " Total = $total";
        }
        echo "</div>";
        return $total;
    }
    
    //add the winner's index (basically the i-th draw)
    function getWinners() {
        global $players, $winners;
        
        $winnersPoints = getWinnersPoint();
        for ($i = 0; $i < 4; $i++) {
            if ($players[$i] == $winnersPoints) {
                array_push($winners, $i + 1);
            }
        }
    }
    
    // gets highest winning points from all four players
    function getWinnersPoint() {
        global $players;
        
        $highest = 0;
        for ($i = 0; $i < 4; $i++) {
            if ($players[$i] >= 0 && $players[$i] <= 42) { // checks if it's withing 0 >= n <= 42
                if ($players[$i] >= $highest) { //checks if it's greater than the previous highest
                    $highest = $players[$i];
                }
            }
        }
        return $highest;
    }
    
    // gets total earnings not including the winning amount
    function getTotalPoints() {
        global $players;
        
        $winnersPoints = getWinnersPoint();
        $total = 0;
        
        for ($i = 0; $i < 4; $i++) {
            if ($players[$i] != $winnersPoints) {
                $total += $players[$i];
            }
        }
        
        return $total;
    }
    
    function play() {
        global $winners, $players;
        
        setDeck();
        
        for ($i = 0; $i < 4; $i++) {
            $playerTotal = draw();
            
            array_push($players, $playerTotal);
            
            echo "<div id='playerpoints'>Points: $players[$i]</div>";
            echo "<hr>";
            echo "<br />";
        }
        
        $winnersPoints = getWinnersPoint();
        $totalEarnings = getTotalPoints();
        
        getWinners();
        // goes through all the winners and prints which player and the points they won
        for ($i = 0; $i < count($winners); $i++) {
            $player = $winners[$i]; 
            echo "<div id='total'> Player $player wins with $winnersPoints points and earns $totalEarnings points</div>";
            echo "<br />";
        }   

    }

?>
