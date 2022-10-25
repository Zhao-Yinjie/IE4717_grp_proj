<!DOCTYPE html>
<html lang="en">
<head>
<title>Lighthouse Island Bistro</title>
<meta charset="utf-8">
<link rel="stylesheet" href=""> 
</head>

<body>

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

<?php
    @ $db = new mysqli('localhost', 'root', '', 'cinema_db');
    $mov_id = $_GET['mov_id'];

    // query to read from db table movie
    $query = 'select * from movie where movie_id =' .$mov_id.';';
    $result = $db->query($query);
    $row = $result->fetch_assoc();

    $title = $row['title'];
    $details = $row['details'];
    $synopsis = $row['synopsis'];
    $timeslot_index = $row['timeslot_index'];
    $price = $row['price'];
    $poster_dir = $row['poster_dir'];

    // read details json string
    $details_json = JSON_decode($details, true);
    $cast = $details_json['Cast'];
    $director = $details_json['Director'];
    $genre = $details_json['Genre'];
    $release = $details_json['Release'];
    $runtime = $details_json['Running Time'];
    $distributor = $details_json['Distributor'];
    $language = $details_json['Language'];

    // convert timeslot index to array
    function convert_to_aray($str){
        $str = explode(',', $str);
        for ($i = 0; $i < count($str); $i++){
            $str[$i] = str_replace('"','',$str[$i]);
            $str[$i] = str_replace('[','',$str[$i]);
            $str[$i] = str_replace(']','',$str[$i]);
            $str[$i] = str_replace(' ','',$str[$i]);
        }
        return $str;
    }

    $timeslot_index = convert_to_aray($timeslot_index);

    // query to read from db table cinema
    $query = 'select * from cinema;';
    $result = $db->query($query);
    $num_results = $result->num_rows;
    $row = $result->fetch_assoc();
    $seats = $row['seats'];
    $timeslot_dict_str = $row['timeslots'];

    $timeslot_dict = JSON_decode($timeslot_dict_str, true);
    $seats_arr = convert_to_aray($seats);


    echo '<div class = "mov_detail">';
        echo '<table>';

        echo '
            <tr>
                <td rowspan="6">
                    <img 
                    src="' . $poster_dir . '"
                    alt="'.$title.'"
                    width="250"
                    height="auto" 
                    >
                <td>
                    <h2>'.$title.'</h2>
                </td>
            </tr>
            <tr>
                <td class="details"> <strong> Cast </strong> <br>' .$cast. ' </td>
                <td class="details"> <strong> Director </strong> <br>' .$director. ' </td>
                
            </tr>
            <tr>
                <td class="details"> <strong> Genre </strong> <br>' .$genre. ' </td>
                <td class="details"> <strong> Distributor </strong> <br>' .$distributor. ' </td>
            </tr>
            <tr>
                <td class="details"> <strong> Release </strong> <br>' .$release. ' </td>
                <td class="details"> <strong> Running Time </strong> <br>' .$runtime. ' </td>
            </tr>
            <tr>
                <td class="details"> <strong> Language </strong> <br>' .$language. ' </td>
            </tr>
            <tr>
                <td colspan="2" class="details"> <strong> Synopsis </strong> <br>' .$synopsis. ' </td>
            </tr>
            ';

        echo '</table>';
    echo '</div>';
    echo '<div class="buy_option">';
        echo '
            <table>
                <tr>
                    <td>
                        <h3> Select Your Timeslot </h3>
                    </td>
                    <td>
                        <h3> Select Your seat </h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <form action="cart.php" method="post">
                            <select name="timeslot" id="timeslot">';
                            for ($i = 0; $i < count($timeslot_index); $i++){
                                echo '<option value="'.$timeslot_index[$i].'"> '.$timeslot_dict[$timeslot_index[$i]].' </option>';
                            }
                    echo '</form>
                    </td>
                    <td>
                        <form action="cart.php" method="post">
                            <table>
                                <tr>';

                                for ($i = 0; $i < count($seats_arr); $i++){
                                    echo '<td> <input type="checkbox" name="seat[]" value="'.$seats_arr[$i].'"> '.$seats_arr[$i].' </td>';
                                if ($i != count($seats_arr)-1)
                                    if ($seats_arr[$i][0] != $seats_arr[$i+1][0]){
                                        echo '</tr><tr>';
                                    }
                                }
                                
                            echo '</tr></table>
                            <input type="submit" value="Add to Cart" > </input>
                            </form>';
                echo '</td>';
                echo '</tr>
            </table>
        ';
    echo '</div>';
?>


</body>