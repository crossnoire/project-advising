<?php
    include 'php/backend/connection.php';
    $id = $_GET['id'];
    $courseid = $_GET['courseid'];

    $sql = "SELECT * FROM subj_course,subject WHERE subj_course.subj_id=subject.subject_id AND subj_yrlvl='1' AND subj_semester='1' AND subj_course.course_id = '".$courseid."'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        $sql2 = "INSERT INTO student_subjs SET stud_id = '".$id."', subject_id = '".$row['subject_id']."'";
        $conn->query($sql2);
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Student Advising System+</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--<link href="css/sidenav.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .sidebar{
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        
      }
    </style>
  </head>
  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      </ul>
      <form class="navbar-form navbar-left">

      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

          <div class="container-fluid">
            <div class="col-md-12">
                <div class="alert alert-info">....</div>
            </div>
            <div class="col-md-2 sidebar">
                <?php include 'php/sidebar.php'?>
            </div>
            <?php
                include 'php/modals.php';
            ?>
            <div class="col-md-10">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title">Advising</h3>
                    </div>
                    <div class="panel-body">
                         <div class="panel panel-default">
                            <table class="table table-striped">
                                <tbody>
                                  <?php
                                      $id = $_GET['id'];

                                      $sql = "SELECT * FROM student,course,college WHERE college.college_id=student.college_id AND course.course_id=student.course_id AND stud_id = '".$id."'";
                                      $result = $conn->query($sql);
                                      $row = $result->fetch_assoc();
                                      echo '
                                            <tr>
                                                <td>Student No.</td>
                                                <td>'.$row['stud_univid'].'</td>
                                                <td>College/Department</td>
                                                <td>'.$row['college_name'].'</td>
                                           </tr>
                                           <tr>
                                                <td>Name</td>
                                                <td>'.$row['stud_fname'].' '.$row['stud_lname'].'</td>
                                                <td>Course</td>
                                                <td>'.$row['course_name'].'</td>
                                           </tr>
                                           <tr>
                                              <td>'.$row['stud_status'].'</td>
                                           </tr>
                                            ';  
                                ?>
                              </tbody>
                            </table>
                         </div>
                    </div>
                  </div>
            </div>

            <div class="col-md-10">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3 class="panel-title">Add Subject</h3>
                  </div>
                  <div class="container-fluid">
                        <table class="table table-striped">
                              <thead>
                                <th>Subject Code</th>
                                <th>Subject Description</th>
                                <th>Subject Units</th>
                                <th>Course</th>
                                <th>Subject Year</th>
                                <th>Subject Semester</th>
                                <th>Add</th>
                              </thead>
                              <tbody>
                                <?php
                                    $sql = "SELECT * FROM subj_course,subject,course WHERE subj_course.subj_id=subject.subject_id AND subj_course.course_id=course.course_id AND subj_course.course_id = '".$courseid."'";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()){
                                            echo '
                                                  <tr>
                                                      <td>'.$row['subject_code'].'</td>
                                                      <td>'.$row['subject_description'].'</td>
                                                      <td>'.$row['subject_units'].'</td>
                                                      <td>'.$row['course_name'].'</td>
                                                      <td>'.$row['subj_yrlvl'].'</td>
                                                      <td>'.$row['subj_semester'].'</td>
                                                      <td><button type="button" class="btn btn-success" onclick="addstudsub('.$id.','.$row['id'].','.$courseid.')">Add</button></td>
                                                  </tr>
                                                ';
                                    }
                                ?>
                              </tbody>
                        </table>

                    
                  </div>
              </div>
          </div>

            
                      <div class="col-md-10 col-md-offset-2" id="advisetbl">
                        <h3>Subject List</h3>
                        <table class="table table-striped">
                              <thead>
                                <th>Subject Code</th>
                                <th>Subject Description</th>
                                <th>Subject Units</th>
                                <th>Course</th>
                                <th>Remove</th>
                              </thead>
                              <tbody id="advstbl">
                                <?php
                                    $sql = "SELECT * FROM student_subjs,subject,subj_course,course WHERE subject.subject_id=subj_course.subj_id AND course.course_id=subj_course.course_id AND student_subjs.subject_id=subject.subject_id AND student_subjs.stud_id = '".$id."'";
                                    $totunits = 0;
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()){
                                        echo '
                                              <tr>
                                                  <td>'.$row['subject_code'].'</td>
                                                  <td>'.$row['subject_description'].'</td>
                                                  <td>'.$row['subject_units'].'</td>
                                                  <td>'.$row['course_name'].'</td>
                                                  <td><button type="button" class="btn btn-danger" onclick="remstudsub('.$id.','.$row['subject_id'].','.$courseid.')">Remove</button</td>
                                              </tr>
                                            ';
                                          $totunits = $totunits + $row['subject_units'];
                                    }
                                ?>    
                              </tbody>
                        </table>
                        <h3>Total Units: <?php echo $totunits?></h3>
                        <button type="button" class="btn btn-info" onclick="printadvslip()">Print Slip</button>
                      </div>
                      
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>