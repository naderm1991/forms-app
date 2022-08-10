<?php
include 'db_connection.php';
include 'Config.php';
?>
<html lang="en">
<style>
</style>
    <head>
        <title>Dejavu Portal System</title>
        <link rel="shortcut icon" href="css/favicon.png" type="image/png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css" >
        <link rel="stylesheet" href="css/jquery.fancybox.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="nav-color navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="Home.php">Dejavu Portal System</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="Home.php">Home</a></li>
                    <?php
                    session_start();
                    if (isset($_SESSION['username']) && isset($_SESSION['Group_Name']))
                    {
                        ///Admin
                        if ( $_SESSION['Group_Name'] == 'admin'  )
                        {
                            $stmt = $conn->prepare("SELECT Acc_Name,Acc_Desc FROM djv_access_tbl where G_ID='4' ");
                            $stmt->execute();
                            $row = $stmt->fetchAll();
                            $count = $stmt->rowCount();
                            if ($count > 0)
                            {
                                ?>
                                <li class="active" class="active">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        Manage Users
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php foreach ($row as $rows) {
                                            ?>
                                            <li>
                                                <a href="<?php echo $rows['Acc_Name'] ?>"><?php echo $rows['Acc_Desc'] ?></a>
                                            </li>
                                        <?php } ?>

                                    </ul>
                                </li>
                                <?php
                            }
                        }
                        ?>
                        <?php
                        if ( $_SESSION['Group_Name'] == 'admin'  || $_SESSION['Group_Name'] == 'TOPManager' )
                        {
                            ?>
                            <li class="active"><a href="Today_Sales.php">Daily Sales</a></li>
                            <li class="active"><a href="Yesterday_Sales.php">Yesterday Sales</a></li>
                            <li class="active"><a href="SalesPeriod.php">Sales Period</a></li>
                            <li class="active"><a href="chart_dashboard.php">Dejavu Sales Dashboard</a></li>
                            <li class="active"><a href="monthlysales.php">monthly sales</a></li>
                            <li class="active"><a href="Stock_Taking_Info.php">Stock Taking Info</a></li>
                            <li class="active"><a href="it_cs_cases.php">CS_Cases</a></li>
                            <li class="active" class="active">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    Tickets Reports<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="styles_ticket_report.php">Master Sheet Report</a></li>
                                    <li><a href="ticketing_report.php">Tickets Report</a></li>
                                </ul>
                            </li>
                            <li class="active"><a href="store_eval.php">Store Evaluation</a></li>

                            <li class="active" class="active"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    Store Complain Ticket<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="storecomplainticket.php">New Ticket</a></li>
                                    <li><a href="search_complain_ticket.php">Search Tickets</a></li>
                                </ul>
                            </li>
                            <li class="active" class="active">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    Quality Ticket<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="storequalityticket.php">New Ticket</a></li>
                                    <li><a href="search_quality_ticket.php">Search Tickets</a></li>
                                </ul>
                            </li>
                            <li class="active" class="active"><a class="dropdown-toggle"
                                                                 data-toggle="dropdown" href="#">Customer Tickets<span
                                            class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="storeticket.php">New Ticket</a></li>
                                    <li><a href="updateticket.php">Update Exist Ticket</a></li>
                                    <li><a href="search ticket.php">Search Tickets</a></li>
                                </ul>
                            </li>
                            <?php
                        }
                    }
                    // Tmanager
                    if (isset($_SESSION['username']) &&
                        ($_SESSION['Group_Name'] == 'TManagers' ) ) {

                        $stmt = $conn->prepare("SELECT Acc_Name,Acc_Desc FROM djv_access_tbl where G_ID='5' ");
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $row = $stmt->fetchAll();
                        // global $row;
                        $count = $stmt->rowCount();

                        if ($count > 0)
                        {
                            foreach ($row as $rows)
                            {
                                ?>
                                <li class="active"><a href="<?php echo $rows['Acc_Name'] ?>"><?php echo $rows['Acc_Desc'] ?></a></li>

                                <?php
                            }

                            ?>

                            <li class="active"><a href="store_eval.php">Store Evaluation</a></li>
                            <li class="active">

                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    Search Tickets<span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="search ticket.php">Customer Tickets</a></li>
                                    <li><a href="search_quality_ticket.php">Quality Tickets</a></li>
                                    <li><a href="search_complain_ticket.php">Complain Tickets</a></li>
                                </ul>

                            </li>

                            <li class="active" class="active">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    Store Tickets<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="storeticket.php">Customer Tickets</a></li>
                                    <li><a href="storequalityticket.php">Quality Tickets</a></li>
                                    <li><a href="storecomplainticket.php">Complain Tickets</a></li>

                                </ul>
                            </li>
                            <?php
                        }
                        ?>
                    <?php


                    }

                    // Stock
                if (isset($_SESSION['username']) && $_SESSION['Group_Name'] == 'Stock') {

                        $stmt = $conn->prepare("SELECT Acc_Name,Acc_Desc FROM djv_access_tbl where G_ID='8' ");
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $row = $stmt->fetchAll();
                        // global $row;
                        $count = $stmt->rowCount();

                        if ($count > 0) {
                            foreach ($row as $rows) {
                                ?>

                                <li class="active">
                                    <a href="<?php echo $rows['Acc_Name'] ?>"><?php echo $rows['Acc_Desc'] ?></a>
                                </li>

                                <?php
                            }

                            ?>
                            <li class="active"><a href="store_eval.php">Store Evaluation</a></li>

                            <?php
                        }
                    }                    

                    // hr
                    if (isset($_SESSION['username']) && isset($_SESSION['Group_Name'])) {

                        if ($_SESSION['Group_Name'] == 'hr' || $_SESSION['Group_Name'] == 'admin') {

                            $stmt = $conn->prepare("SELECT Acc_Name,Acc_Desc FROM djv_access_tbl where G_ID='2' ");
                            $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            $row = $stmt->fetchAll();
                            // global $row;
                            $count = $stmt->rowCount();

                            if ($count > 0) {
                                foreach ($row as $rows) {
                                    ?>

                                    <li class="active">
                                        <a href="<?php echo $rows['Acc_Name'] ?>"><?php echo $rows['Acc_Desc'] ?>
                                        </a></li>

                                    <?php
                                }

                                ?>

                                <?php
                            }
                        }
                    }

                    /// IT
                      if (isset($_SESSION['username']) && $_SESSION['Group_Name'] == 'IT') {

                        $stmt = $conn->prepare("SELECT Acc_Name,Acc_Desc FROM djv_access_tbl where G_ID='1' ");
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $row = $stmt->fetchAll();
                        // global $row;
                        $count = $stmt->rowCount();

                        if ($count > 0) {
                            foreach ($row as $rows) {
                                ?>

                                <li class="active"><a href="<?php echo $rows['Acc_Name'] ?>"><?php echo $rows['Acc_Desc'] ?></a></li>


                                <?php
                            }
                            ?>

                            <li class="active"><a href="store_eval.php">Store Evaluation</a></li>

                            <?php

                        }
                    }

                    // StoreManager
                    if (isset($_SESSION['username'])) {
                        if($_SESSION['Group_Name'] == 'StoreManager' ){

                            $stmt = $conn->prepare("SELECT Acc_Name,Acc_Desc FROM djv_access_tbl where G_ID='7'  ");
                            $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            $row = $stmt->fetchAll();
                            // global $row;
                            $count = $stmt->rowCount();

                            if ($count > 0) {
//                                foreach ($row as $rows) {
//                                    ?>
<!---->
<!--                                    <li class="active"><a href="--><?php //echo $rows['Acc_Name'] ?><!--">--><?php //echo $rows['Acc_Desc'] ?><!--</a></li>-->
<!---->
<!---->
<!--                                    --><?php
//                                }


                                ?>

                                <li class="active">

                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        Search Tickets<span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li><a href="search ticket.php">Customer Tickets</a></li>
                                        <li><a href="search_quality_ticket.php">Quality Tickets</a></li>
                                    </ul>

                                </li>

                                <li class="active" class="active">

                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        Store Tickets<span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li><a href="storeticket.php">Customer Tickets</a></li>
                                        <li><a href="storequalityticket.php">Quality Tickets</a></li>
                                    </ul>

                                </li>

                                <li class="active"><a href="store_eval.php">Store Evaluation</a></li>

                                <?php


                            }
                        }
                    }

                    //AreaManager
                    if (isset($_SESSION['username'])) {

                        if($_SESSION['Group_Name'] == 'AreaManager' || $_SESSION['Group_Name'] == AREA_MANAGER_B
                        ){
                            $stmt = $conn->prepare(
                                    "SELECT Acc_Name,Acc_Desc FROM djv_access_tbl where G_ID='7'  ");
                            $stmt->execute();
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            $row = $stmt->fetchAll();
                            // global $row;
                            $count = $stmt->rowCount();
                            if ($count > 0)
                            {
                                foreach ($row as $rows)
                                {
                                    ?>
                                    <li class="active">
                                        <a href="<?php echo $rows['Acc_Name'] ?>"><?php echo $rows['Acc_Desc'] ?></a>
                                    </li>
                                    <?php
                                }
                                ?>
                                <?php
                            }
                            ?>
                            <li class="active"><a href="store_eval.php">Store Evaluation</a></li>

                            <li class="active"><a href="Today_Sales.php">Daily Sales</a></li>
                            <li class="active"><a href="Yesterday_Sales.php">Yesterday Sales</a></li>
                            <li class="active"><a href="SalesPeriod.php">Sales Period</a></li>
                            <li class="active"><a href="chart_dashboard.php">Dejavu Sales Dashboard</a></li>
                            <li class="active"><a href="monthlysales.php">monthly sales</a></li>
                            <?php


                        }
                    }

                    //Stores
                    if (isset($_SESSION['username'])) {

                        if($_SESSION['Group_Name'] == 'Stores' ){

//                            $stmt = $conn->prepare("SELECT Acc_Name,Acc_Desc FROM djv_access_tbl where G_ID='7'  ");
//                            $stmt->execute();
//                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
//                            $row = $stmt->fetchAll();
//                            // global $row;
//                            $count = $stmt->rowCount();


                            ?>

<!--                            <li class="active"><a href="storeticket.php">Stores Tickets</a></li>-->

                            <li class="active" class="active">

                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    Store Tickets<span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="storeticket.php">Customer Tickets</a></li>
                                    <li><a href="storequalityticket.php">Quality Tickets</a></li>
                                </ul>

                            </li>

                            <li class="active">

                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    Search Tickets<span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="search ticket.php">Customer Tickets</a></li>
                                    <li><a href="search_quality_ticket.php">Quality Tickets</a></li>
                                </ul>

                            </li>

<!--                            <li class="active"><a href="search ticket.php">Search Tickets</a></li>-->

                            <?php

//                            if ($count > 0) {
//                                foreach ($row as $rows) {
//                                    ?>
<!---->
<!--                                    <li class="active"><a href="--><?php //echo $rows['Acc_Name'] ?><!--">--><?php //echo $rows['Acc_Desc'] ?><!--</a></li>-->
<!---->
<!---->
<!--                                    --><?php
//                                }
//
//                                ?>
<!--                                --><?php
//                            }
                        }
                    }


                    if (isset($_SESSION['username'])) {


                        if( $_SESSION['Group_Name'] == 'cs'){

                        $stmt = $conn->prepare("SELECT Acc_Name,Acc_Desc FROM djv_access_tbl where G_ID='3'  ");
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $row = $stmt->fetchAll();
                        // global $row;
                        $count = $stmt->rowCount();
                        ?>

                            <li class="active" class="active">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    Tickets Reports<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="styles_ticket_report.php">Master Sheet Report</a></li>
                                    <li><a href="ticketing_report.php">Tickets Report</a></li>
                                </ul>
                            </li>

                            <li class="active">

                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    Search Tickets<span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="search ticket.php">Customer Tickets</a></li>
                                    <li><a href="search_quality_ticket.php">Quality Tickets</a></li>
                                    <li><a href="search_complain_ticket.php">Complain Tickets</a></li>
                                </ul>

                            </li>

                            <li class="active" class="active">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    Store Tickets<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="storeticket.php">Customer Tickets</a></li>
                                    <li><a href="storequalityticket.php">Quality Tickets</a></li>
                                    <li><a href="storecomplainticket.php">Complain Tickets</a></li>

                                </ul>
                            </li>



                            <?php

//                        if ($count > 0) {
//                            foreach ($row as $rows) {
//                                ?>
<!---->
<!--                                <li class="active"><a href="--><?php //echo $rows['Acc_Name'] ?><!--">--><?php //echo $rows['Acc_Desc'] ?><!--</a></li>-->
<!---->
<!---->
<!--                                --><?php
//                            }
//                        }


                    }
                    }
                    ?>
                                    
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['username'])) { ?>
                        <i class="fas fa-sign-out-alt"></i>
                        <li class="active">
                            <a href="logout.php">
                               Logout</a></li>
                    <?php }
                    ?>
<!--                    --><?php //if (isset($_SESSION['username']) && $_SESSION['Group_Name'] == 'admin') { ?>
<!---->
<!--                        <li class="active">-->
<!--                            <a href="registration.php"><span class="glyphicon glyphicon-log-in"></span>Register new user</a>-->
<!--                        </li>-->
<!--                        --><?php //} ?>

                </ul>
            </div>
        </nav>

    </body>
</html>