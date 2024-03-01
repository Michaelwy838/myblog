<?php


include('config.php');


$sql = "SELECT * FROM dishes";
$result = mysqli_query($conn, $sql);
$dishes = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM dishes WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header('location: dishes.php');
    } else {
        echo 'query error ' . mysqli_error($conn);
    }
}

$sqlusers = "SELECT * FROM users";
$result1 = mysqli_query($conn, $sqlusers);
$users = mysqli_fetch_all($result1, MYSQLI_ASSOC);
$dashboardusers = count($users);

$sqldishes = "SELECT * FROM dishes";
$result2 = mysqli_query($conn, $sqldishes);
$dishes = mysqli_fetch_all($result2, MYSQLI_ASSOC);
$dashboarddishes = count($dishes);

$sqlorders = "SELECT * FROM pendingorders";
$result3 = mysqli_query($conn, $sqlorders);
$orders = mysqli_fetch_all($result3, MYSQLI_ASSOC);
$dashboardorders = count($orders);


?>
<?php
include('header.php');

?>
<!DOCTYPE html>
<html lang="en">
<div class="container">
    <div class="sidebar">
        <a href="index.php" style="text-decoration: none;">
            <h1>DASHBOARD</h1>
        </a>
        <div>
            <a href="pending.php" class="summ">
                <h4>Orders</h4>
                <h4><?php echo $dashboardorders; ?></h4>
            </a>
        </div>
        <div>
            <a href="users.php" class="summ">
                <h4>Users</h4>
                <h4><?php echo $dashboardusers; ?></h4>
            </a>
        </div>
        <div class="active">
            <a href="dishes.php" class="summ">
                <h4>Dishes</h4>
                <h4><?php echo $dashboarddishes; ?></h4>
            </a>

        </div>
    </div>
    <div>
        <h1 style="text-align: center; font-weight: 100; border-bottom: 1px solid white; padding-bottom: 22px;">Dishes Available</h1>
        <table id="users">
            <tr>
                <th>DISH NAME</th>
                <th>PRICE</th>
                <th>ACTION</th>
            </tr>
            <?php for ($i = 0; $i < count($dishes); $i++) { ?>
                <tr>
                    <td><?php echo $dishes[$i]['dishname'] ?></td>
                    <td><?php echo $dishes[$i]['price'] ?></td>
                    <td>
                        <form action="dishes.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $dishes[$i]['id'] ?>">
                            <button name="delete" value="delete" type="delete">Delete</button>
                            <a style="background-color: rgb(0, 172, 232);" href="edit.php?id=<?php echo $dishes[$i]['id'] ?>">Edit</a>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <a style="text-decoration: none; display: block; margin-left: auto; margin-right:auto; width: fit-content; background-color: green; color: white; padding: 10px 20px" href="adddish.php">Add New Dish</a>
    </div>
</div>


<?php

include('../templates/footer.php');
?>

<style>

    .active a{
        background-color: #f2d9f4;
    }

    form .delete,
    .delete {
        width: 150px;
        height: 30px;
        border: none;
        background-color: #ca065d;
        color: white;
        cursor: pointer;
    }

    table {
        width: 70%;
        background-color: white;
        padding: 20px;
        margin: 20px auto;
    }

    form a {
        color: white;
        background-color: #062b61;
        padding: 5px;
        text-decoration: none;
    }

    form button {
        color: white;
        background-color: #dc088a;
        padding: 5px;
        cursor: pointer;
        border: none;
    }

    .summ {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 5px 10px;
        background-color: white;
        margin-bottom: 1px;
    }

    .container {
        display: grid;
        grid-template-columns: 0.3fr 1fr;
        border-bottom: 1px solid #9e9da0;
    }

    .sidebar {
        height: 100vmax;
        background-color: #9e9da0;
        text-align: center;
        width: fit-content;
        width: 100%;
    }
    #users td, #users th{
        border: 1px solid #ddd;
        padding: 8px;
    }
    #users{
        border-collapse: collapse;
    }
    #users tr:nth-child(even){
        background-color: #f2f2f2;
    }
    #users th{
        background-color: green;
        color: white;
        text-align: left;
    }
</style>