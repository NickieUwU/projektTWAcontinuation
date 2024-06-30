<?php
    session_start();
    require("../DbHandler.php");
    $username = $_GET["username"];
    require("../ValidateUser.php");
    require("../ConnectionChecker.php");
    Db::connect("localhost", "sin", "root", "");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ViewReports / Connectify (Admin)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../UniversalCSS/UniversalStyles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../Nav/Nav.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="ViewReports.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php 
        require("../Nav/Nav.php");
    ?>
    <table class="tbreports table table-hover">
        <thead>
            <tr>
                <th>Username</th>
                <th>Report Option</th>
                <th>Report Explanation</th>
                <th>Report Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $reports = Db::queryAll("SELECT * FROM reports");
                foreach($reports as $report)
                {
                    $reportedUserID = $report["UserID"];
                    $reportOption = $report["ReportOption"];
                    $reportExplanation = $report["ReportExplanation"];
                    $reportDate = $report["ReportDate"];
                    $tbtype = "table-primary";
                    switch($reportOption)
                    {
                        case "Spamming":
                            $tbtype = "table-warning";
                            break;
                        case "Fraud":
                            $tbtype = "table-danger";
                            break;
                        case "Bullying":
                            $tbtype = "table-warning";
                            break;
                        case "Copyright":
                            $tbtype = "table-warning";
                            break;
                    }
                    $users = Db::queryAll("SELECT Username FROM users WHERE ID=?", $reportedUserID);
                    foreach($users as $user)
                    {
                        $reportedUsername = $user["Username"];
                        echo "<tr>
                                <td>$reportedUsername</td>
                                <td>$reportOption</td>
                                <td>$reportExplanation</td>
                                <td>$reportDate</td>
                            </tr>";
                    }
                }
            ?>
        </tbody>
    </table>
</body>
</html>