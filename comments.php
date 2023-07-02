<?php
    $page = "Experience Costa Rica - Share your thoughts!";
    include("assets/modular/header.php");

    $servername = "localhost";
    $username = "klo7619";
    $password = getenv('DB_PASSWORD');
    $database = "klo7619";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    
    
    // This function sanitizes strings and integers
    function sanitize($value){
        if (gettype($value) == 'string') {
            $str = htmlentities($value, ENT_QUOTES);
            return $str;
        }
        else if(gettype($value) == 'integer') {
            $int = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
            return $int;
        }
        else {
            echo "Incorrect data type!";
        }
    }

    // This function makes sure that the date value is in mySQL format
    function validateDate($date, $format = 'Y-m-d') {
        $dt = DateTime::createFromFormat($format, $date);
        return $dt && $dt->format($format) === $date;
    }


?>
    <form name="TravelForm" onsubmit="return validateForm();" method="post" action="comments.php">
        <br>
        First name: <input type="text" id="first" name="fName" placeholder="First Name"><br>
        Last name: <input type="text" id="last" name="lName" placeholder="Last Name"><br>
        <br>
        <label for="company">How many in your group?</label>
        <input type="number" id="company" name="groupNum" min="0" max="50" value="0"><br><br>

        <label for="visit">When did you visit? </label>
        <input type="date" name="visitDate" id="visit" required><br><br>

        <fieldset>
            <legend>Favorite Province</legend>
            <input type="radio" id="san_jose" name="favPlace" value="San José">
            <label for="san_jose">San José</label><br>

            <input type="radio" id="heredia" name="favPlace" value="Heredia">
            <label for="heredia">Heredia</label><br>

            <input type="radio" id="cartago" name="favPlace" value="Cartago">
            <label for="cartago">Cartago</label><br>

            <input type="radio" id="alajuela" name="favPlace" value="Alajuela">
            <label for="alajuela">Alajuela</label><br>

            <input type="radio" id="guanacaste" name="favPlace" value="Guanacaste">
            <label for="guanacaste">Guanacaste</label><br>

            <input type="radio" id="limon" name="favPlace" value="Limón">
            <label for="limon">Limón</label><br>

            <input type="radio" id="puntarenas" name="favPlace" value="Puntarenas">
            <label for="puntarenas">Puntarenas</label><br>

            <input type="radio" id="none" name="favPlace" value="None" checked="true">
            <label for="none">None of the above</label><br>
        </fieldset>
        <br>

        <label for="userRating">Rate your Costa Rica experience (Between 0 and 10):</label>
        <input type="range" id="rating" name="userRating" min="0" max="10" value="0" oninput="this.nextElementSibling.value = this.value">
        <output>0</output><br>
        <br>

        Tell us more about your experience:<br>
        <textarea name="userComment" id="comment" placeholder="Place your thoughts here" cols="50" rows="10"></textarea>
        <br>

        <input type="submit" class="button" name="submit" value="Post" />
    </form>

    <?php
        if (!empty($_POST['submit'])) {
            $first = sanitize($_POST['fName']);
            $last = sanitize($_POST['lName']);
            $company = sanitize($_POST['groupNum']);
            if (validateDate($_POST['visitDate'])) {
                $visit = $_POST['visitDate'];
            }
            else {
                echo "Incorrect Date format!";
            }
            $province = sanitize($_POST['favPlace']);
            $rating = sanitize($_POST['userRating']);
            $comment = sanitize($_POST['userComment']);
        }
        
        if ($conn) {
            if(!empty($_POST['submit'])){
                $stmt = $conn->prepare("INSERT INTO `comments_final` (`first`, `last`, `company`, `visit`, `province`, `rating`, `comment`, `posted`) VALUES (?, ?, ?, ?, ?, ?, ?, now());");
                $stmt->bind_param("sssssss", $first, $last, $company, $visit, $province, $rating, $comment);
                $stmt->execute();
                $stmt->close();
            }
            $result = $conn->query('SELECT `first`, `last`, `company`, `visit`, `province`, `rating`, `comment`, `posted` FROM comments_final');
            if ($result) {
                while($rowHolder = $result->fetch_assoc()){
                    $records[] = $rowHolder;
                }
            }
        }
    ?>

    <h3>Comments:</h3>
    <?php
        foreach($records as $row) {
            if (empty($records) || empty($row)) {
                echo "Be the first to add to the discussion!";
            }
            echo "<p class='comment'>";
            echo "Name: " . $row['first'] . " " . $row['last'] . "<br>";
            echo "Number of people in group: " . $row['company'] . "<br>";
            echo "Date visited: " . $row['visit'] . "<br>";
            echo "Favorite province: " . $row['province'] . "<br>";
            echo "Rating: " . $row['rating'] . " out of 10<br>";
            echo "Comment: <br>";
            echo $row['comment'] . "<br>";
            echo "Posted: " . $row['posted'];
            echo "</p>";
        }
    ?>
<?php
    include("assets/modular/footer.php")
?>