<!DOCTYPE html>
<html>
<head>
    <title>Image Uploader</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="images[]" multiple>
        <input type="submit" name="upload" value="Upload">
    </form>

    <?php
    if (isset($_POST['upload'])) {
        $client_id = '6db47bd7029562d'; // Replace with your Imgur client ID

        // Function to upload image to Imgur
        function uploadToImgur($image, $client_id)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
            curl_setopt($ch, CURLOPT_POSTFIELDS, array('image' => base64_encode(file_get_contents($image))));
            $response = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($response, true);
            return $result['data']['link'];
        }

        if (!empty($_FILES['images']['name'][0])) {
            $image_links = array();
            foreach ($_FILES['images']['name'] as $key => $name) {
                $temp_name = $_FILES['images']['tmp_name'][$key];
                $image_link = uploadToImgur($temp_name, $client_id);
                $image_links[] = $image_link;
            }

            // Display uploaded image links
            echo "<h3>Uploaded Image Links:</h3>";
            foreach ($image_links as $link) {
                echo "<img src='$link' alt='Uploaded Image' width='200'><br>";
                echo "<a href='$link' target='_blank'>$link</a><br><br>";
            }
        }
    }
    ?>
</body>
</html>
