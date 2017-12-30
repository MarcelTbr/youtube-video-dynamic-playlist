
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Users View</title>
</head>
<body>
<h1>
    <?php
        echo $welcome;
    ?>

</h1>

<h3><?php

    foreach ($results as $object){

        echo $object->id . " " . $object->username . "<br />";

    }

    ?></h3>


</body>
</html>