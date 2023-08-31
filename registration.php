<?php
require_once('function/function.php');

include('login/session.php');

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $fathername = $_POST['fathername'];
    $gender = $_POST['gender'];

    $data = array('name'=> $name, 'fathername'=> $fathername, 'gender' => $gender);

    $str = http_build_query($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost/myProjects/registrationForm/ajax/ajax.php");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $str);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $output = curl_exec($ch);
    curl_close($ch);
    echo $output;
}



if(isset($_GET['action']) && $_GET['action'] == 'update')
{
    $formname = 'Employee Updation Form';
    $empId = $_GET['id'];
    
    $empData = getDataById('tbl_emloyee', 'id', $empId);
    print_r($empData);
}else{
    $formname = 'Registration Form';
    $empId = '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container p-5 my-5 border">
        <div class="row m-4">
            <div class="col-md-10 text-center">
                <h2><?= $formname ?></h2>
            </div>
            <div class="col-md-2"><a href="list_employee.php"><button class="btn btn-primary">View Employee</button></a>
            </div>
        </div>

        <form action="process.php" method="post">
            <input type="hidden" name="emp_id" value="<?php echo $empId;?>">
            <div class="mb-3 row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name :</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php if(isset($empData)){ echo $empData['name'];} ?>">
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                </div>
                <div class="col-6">
                    <!-- FatherName -->
                    <div class="mb-3">
                        <label for="fathername" class="form-label" >Father's Name : </label>
                        <input type="text" class="form-control" id="fathername" name="fathername" 
                        value="<?php if(isset($empData)){ echo $empData['fathername'];} ?>">
                    </div>
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-6">
                    <!-- Mob -->
                    <label for="mob" class="form-label">Mob : </label>
                    <input type="tel" class="form-control" id="mob" name="mob" value="<?php if(isset($empData)){ echo $empData['mob'];} ?>">
                </div>
                <div class="col-6">
                    <!-- Gender -->
                    <label for="gender" class="form-label">Gender : </label>
                    <br />
                    <div class="btn-group btn-group-toggle" data-toggle="buttons" >
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="M" <?php if(isset($empData) && $empData['gender'] == 'M') {echo "checked = true";} ?> id="gender" required>
                            <label class="form-check-label" for="gender">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="F" id="gender" <?php if(isset($empData) && $empData['gender'] == 'F') {echo "checked = true";} ?>>
                            <label class="form-check-label" for="gender">Female</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-6">
                    <div class="form-group" id="LoginButtonDiv">
                        <label for="dob">D.O.B :</label>
                        <input type="date" id="dob" name="dob" class="form-control" value="<?php if(isset($empData)){ echo $empData['dob'];} ?>">
                    </div>
                </div>
                <div class="col-6">
                    <label for="doj">D.O.J :</label>
                    <input type="date" id="doj" name="doj" class="form-control" value="<?php if(isset($empData)){ echo $empData['doj'];} ?>">
                </div>
            </div>

            <div class="dropdown mb-3 row">

                <div class="col-6">
                    <label for="state" class="form-label">State :</label>
                    <select class="form-control" id="state" name="state"  >
                        <option value="<?php if(isset($empData)){ echo $empData['states'];} ?>">
                            <?php if(isset($empData)){ echo getNameById('states', 'stateName', 'stateID' , $empData['states']);} ?>
                        </option>
                        <!--- Fetching States--->
                        <?php
                        $sql = "SELECT stateID,stateName FROM `states` WHERE countryID ='IND' ORDER BY stateName ASC";
                        $query = mysqli_query($conn, $sql);
                        $rows = mysqli_fetch_all($query);
                        $row_count = mysqli_num_rows($query);
                        if ($row_count > 0) {
                            foreach ($rows as $row) {
                                echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="col-6">
                    <label for="city" class="form-label">City</label>
                    <select name="city" id="city" class="form-control">
                    <option value="<?php if(isset($empData)){ echo $empData['district'];} ?>">
                        <?php if(isset($empData)){ echo getNameById('cities', 'cityName', 'cityID' , $empData['district']);} ?>
                    </option>
                    </select>

                </div>
            </div>

            <div class="mb-3">
                <label for="interests">Interests :</label>
                <div class="mutliSelect">
                    <div>
                        <label class="checkbox"><input type="checkbox" name="interests[]" value="Coding" <?php if(isset($empData) && in_array("Coding", explode(",", $empData['interests']))) {echo "checked = true";} ?>> Coding</label>
                        <label class="checkbox"><input type="checkbox" name="interests[]" value="Cricket" <?php if(isset($empData) && in_array("Cricket", explode(",", $empData['interests']))) {echo "checked = true";} ?>>
                            Cricket</label>
                        <label class="checkbox"><input type="checkbox" name="interests[]" value="Reading" <?php if(isset($empData) && in_array("Reading", explode(",", $empData['interests']))) {echo "checked = true";} ?>>
                            Reading</label>
                        <label class="checkbox"><input type="checkbox" name="interests[]" value="Sleep" <?php if(isset($empData) && in_array("Sleep", explode(",", $empData['interests']))) {echo "checked = true";} ?>> Sleep</label>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="desc">Description:</label>
                <div class="input-group">
                    <span class="input-group-text" id="desc-addon">Enter your description</span>
                    <input type="text" size="100" id="desc" name="desc" class="form-control"
                    aria-describedby="desc-addon" value="<?php if(isset($empData)){ echo $empData['description'];} ?>">
                </div>
            </div>
            <br />

            <div class="mb-3">
                <label for="designation">Designation :</label>
                <div class="input-group">
                    <span class="input-group-text" id="designation-addon">Enter your designation</span>
                    <input type="text" size="15" id="designation" name="designation" class="form-control" 
                    aria-describedby="designation-addon" value="<?php if(isset($empData)){ echo $empData['designation'];} ?>">
                </div>
            </div>
            <br />

            <div style="text-align: center;">
            <?php if($formname == 'Registration Form' ){ ?>
            
                <button type="submit" name="register" value="registerEmp" class="btn btn-primary "
                id="register">Register</button>
            <?php  }
            else{

            ?>
                <button type="submit" name="update" value="updateEmp" class="btn btn-primary" id="update" >Update</button>
            <?php
            }
            ?>
                
            </div>

            <div class="form-group">
                <div id="message" class="col-sm-offset-3 col-sm-6 m-t-15"></div>
            </div>

        </form>

    </div>

    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#state").on("change", function () {

                var stateId = this.value;
                if (stateId != '') {
                    $.ajax({
                        url: 'ajax/ajax.php',
                        type: 'POST',
                        data: { 'action': 'getCity', 'state_id': stateId },
                        success: function (resp) {
                            $("#city").html(resp)
                        }
                    });
                }
            });
        });

        function updateById(id) {            
            $.ajax({
                url: "ajax/ajax.php",
                type: 'POST',
                data: {'action':'updateEmp', emp_id:id},
                success: function (data, status) {
                  if(data)
                  {
                    resp =JSON.parse(data);
                    alert(resp.description);
                    location.reload();
                  }
                }
            })
       }


    </script>

</body>
</html>