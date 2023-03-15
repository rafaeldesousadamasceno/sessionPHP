<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session PHP</title>
</head>

<body>
    <form method="POST">
        <label for="numberslist">Número: </label>
        <input type="number" name="numberslist">
        <input type="submit" value="Add" name="oper">
        <input type="submit" value="Del" name="oper">
        <input type="submit" value="Sort" name="oper">
        <input type="submit" value="Clear" name="oper">
    </form>
    <div>
        <ul>
            <?php
            session_start();
            if (isset($_SESSION["numbers"]))
                $numbers = $_SESSION["numbers"];
            else
                $number = array();

            if (isset($_POST["numberslist"])) {
                switch ($_POST["oper"]) {
                    case 'Add':
                        $numbers[] = $_POST["numberslist"];
                        break;

                    case 'Del':
                        $indice = array_search($_POST["numberslist"], $numbers);
                        if($indice != "")
                            array_splice($numbers, $indice, 1);
                        break;

                    case 'Sort':
                        sort($numbers);
                        break;

                    case 'Clear':
                        $numbers = array();
                        unset($_SESSION["numbers"]);
                        session_destroy();
                        break;
                }
            }
            if (count($numbers) > 0) {
                for ($i=0; $i < count($numbers); $i++) {
                    echo("<li>$numbers[$i]</li>");
                }
            }
            $_SESSION["numbers"] = $numbers;
            ?>
        </ul>
    </div>
</body>

</html>