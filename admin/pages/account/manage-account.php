<?php
session_start();
if (isset($_SESSION['id'])) {
    include('../../../database/dbcon.php');
    require('../../../library/function.php');
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Account(s)</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="/DrunkinDonut/admin/public/css/style.css?v=<?php echo time(); ?>">
        <script src="/DrunkinDonut/admin/public/js/script.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    </head>

    <body>
        <?php include '../../include/header.php'; ?>
        <div class="main">
            <?php
            include '../../include/toggle.php';
            include '../../include/search.php';
            $i = 0;
            $j = 0;
            $roleID = array();
            $roleName = array();
            $numRole = getResult($con, 'RoleName', 'Role', 'ORDER BY RoleName', '', 'count');
            $getRole = mysqli_query($con, "SELECT * FROM `Role` ORDER BY RoleName");
            while ($rowRole = mysqli_fetch_array($getRole)) {
                $roleID[] = $rowRole['RoleID'];
                $roleName[] = $rowRole['RoleName'];
                $j++;
            }
            // tổng số account trả về
            $numStart = 0;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                $numStart = 12 * ($page - 1);
            }
            $condition = "";
            if (isset($_GET['search'])) {
                $key = $_GET['search'];
                $condition = "WHERE AccName LIKE '%$key%' OR AccEmail LIKE '%$key%'";
            }
            $pageItem = 12;
            $query = "SELECT * FROM `Account` 
                        INNER JOIN `Role` ON account.RoleID = role.RoleID $condition
                        ORDER BY AccountID LIMIT $pageItem OFFSET $numStart";
            $getAll = "SELECT * FROM `Account` 
                        INNER JOIN `Role` ON account.RoleID = role.RoleID $condition";
            $totalItem = getResultByQuery($con, $query, 'count');
            $getAccount = mysqli_query($con, $query);

            if ($totalItem == 0) { ?>
                <div class="message">Không Có Kết Quả Trùng Khớp</div>
            <?php } else { ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <table id="account">
                        <thead>
                            <tr>
                                <!-- <th style="width:5%;"><input type="checkbox" id="checkAll" value="" onclick="toggle(this)" /></th> -->
                                <th>ID </th>
                                <th>Username</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Edit Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($getAccount)) { ?>
                                <tr>
                                    <!-- <td><input type="checkbox" class="checkBox" name="choose_all[]" value="<?php echo $row['AccountID'] ?>" /></td> -->
                                    <td><?php echo $row['AccountID'] ?></td>
                                    <td><?php echo $row['AccName'] ?></td>
                                    <td><?php echo $row['AccPhoneNo'] ?></td>
                                    <td><?php echo $row['AccEmail'] ?></td>
                                    <td><?php echo $row['RoleName']; ?></td>
                                    <td>
                                        <button type="button" id="edit<?php echo $i ?>" class="fa fa-pencil-square-o" onclick="openModal(this.id)"></button>
                                        <!-- Modal content -->
                                        <form action="manage-account.php?action=edit&id=<?php echo $row['AccountID']; ?>" method="POST" role="form" enctype="multipart/form-data">
                                            <div id="myModal-edit<?php echo $i ?>" class="modal">
                                                <div class="modal-content">
                                                    <div class="modal-head">
                                                        <h1>Account #<?php echo $row['AccountID'] ?> </h1>
                                                        <span class="close" id="close-edit<?php echo $i ?>">&times;</span>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="details">
                                                            <b>Username:</b> <?php echo $row['AccName'] ?> <br>
                                                            <b>Email:</b> <?php echo $row['AccEmail'] ?> <br>
                                                            <b>Role:</b> <?php echo $row['RoleName'] ?>
                                                        </div>
                                                        <h3>Edit Role: </h3>
                                                        <select id="role-list-<?php echo $row['AccountID'] ?>" name="roleList">
                                                            <?php
                                                            for ($index = 0; $index < $numRole; $index++) { ?>
                                                                <option value="<?php echo $roleID[$index] ?>"><?php echo $roleName[$index]; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <div class="option">
                                                            <button type="button" id="edit-account-<?php echo $row['AccountID'] ?>" onclick="passSelect(this.id)">Save Change</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </form>
            <?php } ?>
            <?php include '../../include/pagination.php'; ?>
        </div>
    </body>

    </html>
<?php
    if (isset($_GET['edit-account'])) {
        $editID = $_GET['edit-account'];
        $newRole = $_GET['role'];
        updateItem($con, "Account", "RoleID = $newRole", "AccountID = $editID");
        echo "<script>window.location.href = '/DrunkinDonut/admin/pages/account/manage-account.php'</script>";
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>