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
    // query to read from db
    $query = "select * from movie";
    $result = $db->query($query);
    $num_results = $result->num_rows;

    $movie_list = [];
    while ($row = $result->fetch_assoc()){
        // get info from query result
        $mov_id = $row['movie_id'];
        $title = $row['title'];
        $poster_dir = $row['poster_dir'];


        $movie_detail = array(
            'mov_id' => $mov_id,
            'title' => $title,
            'poster_dir' => $poster_dir
        );

        $movie_list = array_merge($movie_list, array($movie_detail));
    }


    
?>

<div id="wrapper">


    <!-- Header Menu of the Page -->
    <header>
        
        <!-- Top header menu containing
            logo and Navigation bar -->
        <div>
            <!-- Logo -->
                <h2>
                    4717 Cinema
                </h2>
       
            <!-- Navigation Menu -->
            <div>
                <a class="current_page" href="index.php">Home</a>
                <a href="cart.php">Cart</a> 
            </div> 
            
        </div>   
    
        <!-- Image menu in Header to contain an Image and
            a sample text over that image -->

    </header>

    <div class="content"> 
        <table>
            <?php 
                echo "<br><br>
                        <table>
                        <tr>
                    ";
                $i = 0;
                $lst_len=count($movie_list);
                while ($i < $lst_len)
                {
                    // echo the movie details in table rows cells
                    // now this is array of hash
                    $movie = $movie_list[$i];
                    $mov_id = $movie['mov_id'];
                    $title = $movie['title'];
                    $poster_dir = $movie['poster_dir'];
                    
                    echo '
                        
                            <td> 
                                <a href="mov_detail.php?mov_id=' . $mov_id . '">
                                    <img 
                                        src="' . $poster_dir . '"
                                        alt="'.$title.'"
                                        width="170"
                                        height="auto" 
                                    >
                                </a>
                                <br>
                                <strong> ' . $title . ' </strong>
                            </td>
                        ';
                    
                    if ($i % 3 == 2 || $i == $lst_len - 1)
                    {
                        echo "</tr>";
                    }
                    
                    $i++;
                }

                echo "</table>";
            ?>
            
        </table>
    </div>

    <footer> 
        <br>
        <em> Copyright &copy; 2014 JavaJam Coffee House </em><br>
        <a href="yinjie@zhao.com"><em>yinjie@zhao.com</em></a>
    </footer> 





</body>

</html>
