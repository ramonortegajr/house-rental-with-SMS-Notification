<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            Suggestions
        </div>

        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Suggestion ID</th>
                        <th>Complain/Suggestions</th>
                        <th>Room #</th>
                        <th>Complainant</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                        include('db_connect.php');
                                $sql = "SELECT s.id, s.suggestion_text, s.status, s.room_number, CONCAT(t.firstname, t.middlename, t.lastname) AS fullname FROM suggestion AS s LEFT JOIN tenants AS t ON s.tenant_id = t.id";
                                $result = mysqli_query($conn,$sql);
                               while($row = mysqli_fetch_array($result)) {
                        ?>
                        <td><?php echo $row['id'];?></td>
                        <td><?php echo $row['suggestion_text'];?> </td>
                        <td><?php echo $row['room_number'];?> </td>
                        <td><?php echo $row['fullname'];?> </td>
                        <td><?php echo $row['status'];?> </td>
                        <td class="text-center">
						<a href="sugg_fix.php?id=<?php echo $row['id'];?>"><button class="btn btn-sm btn-outline-primary view_payment" type="button">Done</button></a>
						</td>
                        <?php }?>
                    </tr>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>