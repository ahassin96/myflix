<?php

require 'vendor/autoload.php';

use MongoDB\Client;

$mongoClient = new Client("mongodb://ec2-44-221-241-112.compute-1.amazonaws.com:27017");

$database = $mongoClient->myflix;

$genres = ['horror', 'military', 'action'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyFlix Video Library</title>
</head>
<body>
    <h1>MyFlix Video Library</h1>

    <div class="video-container" id="horror-container">
        <?php foreach ($horrors as $horror): ?>
            <div class="video">
                <video controls>
                    <source src="<?php echo $video['url']; ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        <?php endforeach; ?>

        
    </div>
</body>
</html>