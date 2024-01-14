<?php
session_start();
require 'vendor/autoload.php';

use MongoDB\Client;

$mongoClient = new Client("mongodb://ec2-54-221-90-30.compute-1.amazonaws.com:27017");

$database = $mongoClient->admin;

$genres = ['horror', 'military', 'action'];

echo  $_SESSION['user_id'];
echo  $_SESSION['username'];
if (isset($_GET['selectedProfile'])) {

        
        $_SESSION['userProfile'] = $_GET['selectedProfile'];
        echo $_SESSION['userProfile'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>MyFlix Video Library</title>
</head>
<body>
    <h1>MyFlix Video Library</h1>


    <?php
   <?php
    try {
        foreach ($genres as $genre) {
            $flask_url = "http://3.90.74.38:9090/movies"; 
            $json_data = file_get_contents($flask_url);
            $videos = json_decode($json_data, true)[$genre];
            ?>

            <div class="video-container" id="<?php echo $genre; ?>-container">
                <h2><?php echo ucfirst($genre); ?></h2>

                <?php
                foreach ($videos as $video) {
                    ?>
                    <div class="video">
                        <p><?php echo $video['title']; ?></p>
                        <a href="<?php echo $video['watch_details']; ?>">Watch Details</a>

                        <video controls>
                            <source src="<?php echo $video['url']; ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <?php
                }
                ?>
            </div>

            <?php
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>


</body>
</html>