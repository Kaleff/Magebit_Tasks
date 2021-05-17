<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Database view</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        .redButton {
            margin: 2px;
            height: 40px;
            width: 100px;
            background-color:  #ff4d4d;
        }
        .button {
            margin:10px 20px 10px 20px;
            min-height: 40px;
            max-height: 80px;
            width: 190px;
        }
        .buttonActive {
            margin:10px 20px 10px 20px;
            min-height: 40px;
            max-height: 80px;
            width: 190px;
            background-color: #ff8080;
        }
        .buttons {
            display: inline-block;
        }
        .articles{
            width:300px;
            height:160px;
            border-style: solid;
            border-color:#111111;
            border-width: 2px;
            margin-top:25px;
            margin-left:25px;
            margin-right:25px;
            padding: 25px;
            display: inline-block;
        }
        .whiteButton {
            margin:5px;
            background-color: #FFFFFF;
        }
        .grayButton {
            margin:5px;
            background-color: #a6a6a6;
        }
    </style> <!-- Basic CSS style in the same file for the simplicity sake-->
</head>
<body>
    <header>
        <h2>Viewing the database</h2>
        <h3>Filter by domain</h3>
        <div class="buttons">
        <?php while($row = $this->data["pdoCategories"]->fetch(PDO::FETCH_OBJ))
        {
            if($row->id == $this->data['categoryFilter']) {
                echo "<a href='/database'><button class='buttonActive'>Remove filter on @" . $row->domain_name . " domain e-mails</button></a>";
            }
            else {
                $path = "/database/domain/" . $row->id;
                echo "<a href='$path'><button class='button'>Show only @" . $row->domain_name . " domain e-mails</button></a>";
            }
        }
        ?>
        </div>
        <h3>Sort records by:</h3>
        <form method="post">
            <select name="ORDER_BY" required="required">
                <option value="id">Sort by Date</option>
                <option value="email">Sort by Name</option>
            </select>
            <select name="orderDirection" required="required">
                <option value="DESC">in descending order</option>
                <option value="ASC">in ascending order</option>
            </select>
        <?php
        if(isset($_POST['ORDER_BY']) &&
        isset($_POST['orderDirection'])) {
            echo "<h4>Currently sorted by ";
            switch ($_POST['ORDER_BY']) {
                case "id":
                    echo "Date ";
                    break;
                case "email":
                    echo "Name ";
                    break;
            }
            echo "in " . strtolower($_POST['orderDirection']) . "ending order.</h4>";
        } else {
            echo "<h4>Currently sorted by Date, in descending order (Newest First, Default)</h4>";
        }
        ?>
            <h3>Search: </h3>
            <input type="text" placeholder="Search.." name="searchRequest">
            <input type="submit" value="Search">
        </form>
        <hr>
    </header>
    <h3>Download records as a CSV file:</h3>
    <input type="submit" form="checkboxes" value="Download">
    <div class="article">
        <form id="checkboxes" action="/print" method="post">
        </form>
        <?php $counter=0;
        while($row = $this->data["pdoInfo"]->fetch(PDO::FETCH_OBJ))
        {
            if(isset($_POST['searchRequest'])) {
                if(preg_match("/". $_POST['searchRequest'] . "/", $row->email)) { ?>
                    <div class="articles">
                        <input form="checkboxes" type="checkbox" name="id<?php echo $row->id;?>" value="<?php echo $row->id; ?>">
                        <p><?php echo $row->email;?></p>
                        <p><?php echo $row->pubdate;?></p>
                        <form method="post"><a><button type="submit" class="redButton" name="deleteId" value="<?php echo $row->id;?>">Delete Record</button></a></form>
                    </div>
            <?php
                }
            } else { ?>
                <div class="articles">
                    <input form="checkboxes" type="checkbox" name="id<?php echo $row->id;?>" value="<?php echo $row->id; ?>">
                    <p><?php echo $row->email;?></p>
                    <p><?php echo $row->pubdate;?></p>
                    <form method="post"><a><button type="submit" class="redButton" name="deleteId" value="<?php echo $row->id;?>">Delete Record</button></a></form>
                </div>
            <?php
            }
        }
        ?>
    </div>
</body>

</html>