<!DOCTYPE html>
<html lang="en">
<head>
<title>Lighthouse Island Bistro</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/index_style.css"> 
</head>
<body>

<?php
    @ $db = new mysqli('localhost', 'root', '', 'cinema_db');

    $query = "select * from movie";
    $result = $db->query($query);
    // get title from result
    $num_results = $result->num_rows;

    $movie_list = [];
    while ($row = $result->fetch_assoc()){
        $title = $row['title'];
        $poster_dir = $row['poster_dir'];
        $details = $row['details'];
        $synopsis = $row['synopsis'];
        $timeslot_index = $row['timeslot_index'];
        $price = $row['price'];

        $movie_detail = array(
            'title' => $title,
            'poster_dir' => $poster_dir,
            'details' => $details,
            'synopsis' => $synopsis,
            'timeslot_index' => $timeslot_index,
            'price' => $price
        );

        $movie_list = array_merge($movie_list, array($movie_detail));
    }


    
?>

<div id="wrapper">

    <header>
        <h1> IE4717 Cinema </h1>
    </header>
    <div id="leftcolumn">
        <nav>
            <br>
            <a class="current_page" href="index.php">Home</a>
            <a href="Menu.php">Menu</a> 
            <a href="Music.html">Music</a> 
            <a href="Jobs.html">Jobs</a> 
            <a href="Menu_admin.php">Price</a>
            <a href="order_summary.php">Report</a>
        </nav> 
        <!-- <br><br><br><br><br><br><br><br> -->
    </div>
    <div id="rightcolumn">
        <div class="content"> 
            <table>
                <?php 
                    for ($i=0, $len=count($movie_list); $i < $len; $i+=1)
                    {
                        // echo the movie details in table rows cells
                        // now this is array of hash
                        $movie = $movie_list[$i];
                        $title = $movie['title'];
                        $poster_dir = $movie['poster_dir'];
                        $details = $movie['details'];
                        $synopsis = $movie['synopsis'];
                        $timeslot = $movie['timeslot_index'];
                        $price = $movie['price'];

                        echo "<tr>";
                            echo '<td>' . $title . '</td>';
                            
                            
                        echo "</tr>";
                    }
                ?>
                
            </table>
    </div>

    <footer> 
        <br>
        <em> Copyright &copy; 2014 JavaJam Coffee House </em><br>
        <a href="yinjie@zhao.com"><em>yinjie@zhao.com</em></a>
    </footer> 

</div>



</body>

</html>
