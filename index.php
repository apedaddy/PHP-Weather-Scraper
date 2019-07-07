<?php
$weatherInfo = "";
$errorInfo = "";
if ($_GET['city']) {
    $city = str_replace(' ', '', $_GET['city']);
    // some cities may have name with space(s) in the middle example: Addis Ababa, San Francisco etc
    $file_headers = @get_headers("https://www.weather-forecast.com/locations/" . $city . "/forecasts/latest");
    if (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
        $errorInfo = "The city could not be found";
    } else {
        $weatherReport = file_get_contents("https://www.weather-forecast.com/locations/" . $city . "/forecasts/latest");
        $wholePageArray = explode('(1&ndash;3 days)</span><p class="b-forecast__table-description-content"><span class="phrase">', $weatherReport);
        $specificArray = explode('</span></p></td><td class="b-forecast__table-description-cell--js"', $wholePageArray[1]);
        $weatherInfo = $specificArray[0];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="weatherscraper.css">
    <title>Weather Scraper</title>
</head>

<body>
    <div class="container">
        <h1> Check Current Weather</h1>
        <form>
            <div class="form-group">
                <label for="city">Enter name of the City. Plan Ahead.</label>
                <input type="text" class="form-control" id="city" name="city" aria-describedby="emailHelp" placeholder="Eg. London, Antwerp, Kathmandu etc" value="<?php echo $_GET['city']; ?>">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div id="weather">
            <?php

            if ($weatherInfo) {

                echo '<div class="alert alert-success" role="alert">' . $weatherInfo . '</div>';
            } else if ($errorInfo) {
                echo '<div class="alert alert-danger" role="alert">' . $errorInfo . '</div>';
            }
            ?></div>
    </div>

    </div>





    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>

</html>