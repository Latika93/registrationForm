<?php 
require_once('../includes/config.php');

getAllData($conn);

// if(isset($_POST['displaySend'])){
//     $sql = "SELECT * from userinfo";
//     $rows = mysqli_query($conn, $sql);
//     foreach($rows as $row) {
//       echo "<tr>";
  
//       if (isset($_GET['id']) && $row['id'] == $_GET['id']) {
//           echo '<form class="form-inline m-2" action="update.php" method="POST">';
//           echo '<td><input type="text" class="form-control" name="name" value="'.$row['name'].'"></td>';
//           echo '<td><input type="text" class="form-control" name="fathername" value="'.$row['fathername'].'"></td>';
//           echo '<td><input type="integer" class="form-control" name="mob" value="'.$row['mob'].'"></td>';
//           echo '<td><input type="text" class="form-control" name="gender" value="'.$row['gender'].'"></td>';
//           echo '<td><button type="submit" class="btn btn-primary">Save</button></td>';
//           echo '<input type="hidden" name="id" value="'.$row['id'].'">';
//           echo '</form>';
//       } else {
//           echo "<td>" . $row['name'] . "</td>";
//           echo "<td>" . $row['fathername'] . "</td>";
//           echo "<td>" . $row['mob'] . "</td>";
//           echo "<td>" . $row['gender'] . "</td>";
//           echo "<td>" . $row['dob'] . "</td>";
//           echo "<td>" . idToState($row['states'], $conn) . "</td>";
//           echo "<td>" . $row['district'] . "</td>";
//           echo "<td>" . $row['interests'] . "</td>";
//           echo "<td>" . $row['description'] . "</td>";
//           echo "<td>" . $row['doj'] . "</td>";
//           echo "<td>" . $row['designation'] . "</td>";
//         //   echo '<td><a class="btn btn-primary" href="registration.php?id=' . $row['id'] . '" role="button">Update</a></td>';          
//         //   echo '<td><a class="btn btn-danger" href="registration.php?id=' . $row['id'] . '" role="button">Delete</a></td>';
//         // echo '<td><a class="btn btn-danger" href="function/delete.php?id=' . $row['id'] . '" role="button">Delete</a></td>';
//         // echo "<td><a class='btn btn-danger' onclick='deleteById(" . $row['id'] . ", " . $conn . ")'  "' role='button'>Delete</a></td>";
//         ?>
//            <td><a class='btn btn-danger' onclick='deleteById( <?php $row[id] ?>)' role='button'>Delete</a></td>";
//         <?php
          
//       }
  
//       echo "</tr>";
// }



// }

?>