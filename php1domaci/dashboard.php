<?php
session_start();
?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>PWA</title>
    </head>
    <body>


<?php
    require_once 'db/connection.php';

    $machines = $pdo->query("SELECT * FROM machines")->fetchAll();

if(isset($_GET['action']))
{
    $akcija = $_GET['action'];
    $id = $_GET['id'];

    if($akcija == 'delete')
    {
       $stmt= $pdo->prepare ("DELETE FROM machines WHERE id=:id");
       $stmt->bindParam(':id', $id);
       $stmt->execute();
       header('Location:./dashboard.php');
    }

    if($akcija == 'start')
    {

        $machine = $pdo->prepare("SELECT * FROM machines WHERE id = :id");
        $machine->bindParam(':id', $id);
        $machine->execute();
        $masina= $machine->fetch();

        if($masina)
        {

            $x = "RUNNING";
            if($masina['status'] == $x)
            {
                $_SESSION['errorsAction'] = "Masina je vec pokrenuta";
            } else
            {

                $stat = $pdo->prepare("UPDATE machines set status=:status WHERE id=$id");
                $stat->bindParam(':status', $x);
                $greska = $stat->execute();
                sleep(2);
                if($greska)
                {
                    unset($_SESSION['errorsAction']);
                }
                echo "Masina je pokrenuta";
            }
        }
    }
    if($akcija == 'stop')
    {
        $machine = $pdo->prepare("SELECT * FROM machines WHERE id = :id");
        $machine->bindParam(':id', $id);
        $machine->execute();
        $masina= $machine->fetch();

        if($masina)
        {

            $x = "STOPPED";
            if($masina['status'] == $x)
            {
                $_SESSION['errorsAction'] = "Masina je vec stopirana";
            } else
            {

                $stat = $pdo->prepare("UPDATE machines set status=:status WHERE id=$id");
                $stat->bindParam(':status', $x);
                $greska = $stat->execute();
                sleep(2);
                if($greska)
                {
                    unset($_SESSION['errorsAction']);
                }
                echo "Masina je stopirana";
            }
        }
    }
    if(isset($_SESSION['errorsAction']))
    {
        echo $_SESSION['errorsAction'];
    }
}
?>
<?php

extract($_GET);

require_once 'db/connection.php';

if (isset($search) && isset($searchBy)) {
    $stmt =  $pdo->prepare("SELECT * FROM machines WHERE $searchBy LIKE :search ");
    $parameters = [
        'search' => "%" . $search . "%"
    ];
    $stmt->execute($parameters);
    $machines = $stmt->fetchAll();
}
?>


    <form action="<?= $_SERVER["PHP_SELF"]; ?>" method="GET">
        <select id="searchBy" name="searchBy">
            <option value="name">naziv</option>
            <option value="ram">ram</option>
        </select>
        <input type="text" name="search" placeholder="Search">
        <input type="submit" value="Search">
    </form>

    <ul>
        <?php foreach($machines as $machine): ?>
            <li>
                Ime masine: <?= $machine['name']?>
                <a href="<?= $_SERVER["PHP_SELF"]; ?>?id=<?= $machine['id']?>&action=start"><br>
                    START
                </a>
                <a href="<?= $_SERVER["PHP_SELF"]; ?>?id=<?= $machine['id'] ?>&action=stop"><br>
                    STOP
                </a>
                <a href="<?= $_SERVER["PHP_SELF"]; ?>?id=<?= $machine['id'] ?>&action=delete"><br>
                    DESTROY
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

<?php

    extract($_POST);
    if(isset($name))
    {
        $uuid = md5($name);
        if ($name == '' || strlen($name) < 3)
        {
            $_SESSION['errorsMachine'] = 'Naziv masine je obavezan i ne sme biti kraci od 3 slova!';
        } elseif($ram == '') {
            $_SESSION['errorsMachine'] = 'Ram polje je obavezno!';
        } elseif ( $ram <= 0 || $ram >= 64)
        {
            $_SESSION['errorsMachine'] = 'Ram mora biti pozitivan i manji od 64!';
        }
        else {
            $stmt = $pdo->prepare("INSERT into machines values('', :uuid, :name, 'STOPPED', now(), true, :ram, 0)");
            $stmt->bindParam(':uuid', $uuid);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':ram', $ram);
            if($stmt->execute())
            {
                unset($_SESSION['errorsMachine']);
            }
        }
        if(isset($_SESSION['errorsMachine']))
        {
            echo $_SESSION['errorsMachine'];
        }
        header('Location:./dashboard.php');
    }

?>
    <form action="<?= $_SERVER["PHP_SELF"]; ?>" method="POST">
        <h3>Napravi novu masinu:</h3>
        Unesite naziv masine: <input type="text" name="name"><br>
        Unesite velicinu ram-a: <input type="number" name="ram">
        <input type="submit">
    </form>

