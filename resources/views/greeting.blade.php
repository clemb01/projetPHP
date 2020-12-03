<html>
    <body>
        <?php
            foreach($tests as $test)
            {   
                ?>             
                <h1>Hello, {{ $test->name }}</h1>
                <h1>Hello, {{ $test->firstname }}</h1>
                <?php
            }
        ?>
    </body>
</html>