<?php
require_once('function/function.php');
require_once('ajax/ajax.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container pt-5 my-5 border">


        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10 text-center">
                        <h2>Employee List</h2>
                    </div>
                    <div class="col-md-2"><a href="registration.php"><button class="btn btn-primary">Add New
                                Employee</button></a></div>
                </div>
            </div>

            <div class="card-body" id="emp_list">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Emp ID</th>
                            <th>Name</th>
                            <th>Father's Name</th>
                            <th>Mobile</th>
                            <th>Gender</th>
                            <th>D.O.B</th>
                            <th>State</th>
                            <th>District</th>
                            <th>Interests</th>
                            <th>Description</th>
                            <th>D.O.J</th>
                            <th>Designation</th>
                            <th style="width:10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $table = 'tbl_emloyee';
                        $emplist = getAllData($table);
                        if (!empty($emplist)) {
                            foreach ($emplist as $emp) { ?>
                                <tr>
                                    <td>
                                        <?= $emp['id'] ?>
                                    </td>
                                    <td>
                                        <?= $emp['name'] ?>
                                    </td>
                                    <td>
                                        <?= $emp['fathername'] ?>
                                    </td>
                                    <td>
                                        <?= $emp['mob'] ?>
                                    </td>
                                    <td>
                                        <?= $emp['gender'] ?>
                                    </td>
                                    <td>
                                        <?= $emp['dob'] ?>
                                    </td>
                                    <td>
                                        <?=getNameById('states','stateName','stateID',$emp['states']);  ?>
                                    </td>
                                    <td>
                                        <?=getNameById('cities','cityName','cityID',$emp['district']); ?>
                                    </td>
                                    <td>
                                        <?= $emp['interests'] ?>
                                    </td>
                                    <td>
                                        <?= $emp['description'] ?>
                                    </td>
                                    <td>
                                        <?= $emp['doj'] ?>
                                    </td>
                                    <td>
                                        <?= $emp['designation'] ?>
                                    </td>
                                    <td>

                                        <a href="registration.php?id=<?= $emp['id'] ?>&action=update" class="btn tbn-success">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>&nbsp;&nbsp;

                                        <a onclick="deleteById(<?=  $emp['id'] ?>)" class="btn tbn-success">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>

                                    </td>
                                </tr>
                            <?php }
                        } else {

                            ?>

                            <div class="card">
                                <div class="card-body">
                                    This is some text within a card body.
                                </div>
                            </div>

                            <?php
                        }

                        ?>

                    </tbody>
                </table>
            </div>
        </div>

        <!-- import a file -->

        <div id="wrap">
            <div class="container">
                <form class="form-horizontal" action="upload.php" method="post" name="upload_excel"
                    enctype="multipart/form-data">
                    <fieldset>
                        <!-- File Button -->

                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label class=" control-label" for="filebutton">Select File</label>
                                    <div class="">
                                        <input type="file" name="file" id="file" class="input-large">
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <label class=" control-label" for="singlebutton"></label>
                                <div class="">
                                    <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading"
                                        data-loading-text="Loading...">Import</button>
                                </div>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>


    </div>

    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

    <script>
        function deleteById(id) {            
             $.ajax({
                 url: "ajax/ajax.php",
                 type: 'POST',
                 data: {'action':'deleteEmp',emp_id:id},
                 success: function (data, status) {
                   if(data)
                   {
                     resp =JSON.parse(data);
                     alert(resp.description);
                     $("#emp_list").load(window.location.href + " #emp_list" );
                   }                   
                }
             })
        }
    </script>

</body>

</html>