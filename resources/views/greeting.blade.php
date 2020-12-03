<html>
    <body>
    <?php
        echo "Page: " . $model->page;
        foreach($model->results as $result)
        {
            echo "<br />";
            var_dump($result);
        }
    ?>
    </body>
</html>