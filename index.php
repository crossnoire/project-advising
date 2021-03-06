<?php
    include 'php/backend/connection.php';
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
      <a class="navbar-brand" href="#">Student Advising System</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      </ul>
      <form class="navbar-form navbar-left">

      </form>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

    <div>
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
                      <h3 class="panel-title">Student List</h3>
                    </div>
                    <div class="panel-body">
                          <h2 class="sub-header">Recently Added</h2>
                          <div class="table-responsive">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th>Student #</th>
                                  <th>Name</th>
                                  <th>College</th>
                                  <th>Course</th>
                                  <th>Edit Details</th>
                                  <th>Advise</th>
                                </tr>
                              </thead>
                              <tbody id="pagina-tbl">
                                <?php
                                    $sql = "SELECT * FROM student LIMIT 0,8";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()){
                                      echo '
                                          <tr>
                                            <td>'.$row['stud_univid'].'</td>
                                            <td>'.$row['stud_fname'].', '.$row['stud_lname'].'</td>
                                            ';

                                            $sql2 = "SELECT college_name FROM college WHERE college_id = '".$row['college_id']."'";
                                            $result2 = $conn->query($sql2);
                                            $row2 = $result2->fetch_assoc();
                                      echo '
                                          <td>'.$row2['college_name'].'</td>
                                          ';
                                          $sql2 = "SELECT course_name FROM course WHERE course_id = '".$row['course_id']."'";
                                          $result2 = $conn->query($sql2);
                                          $row2 = $result2->fetch_assoc();

                                      echo '
                                          <td>'.$row2['course_name'].'</td>
                                           <td><a href="editstudent.php?id='.$row['stud_id'].'&courseid='.$row['course_id'].'"><button type="button" class="btn btn-success">Edit</button></a></td>
                                           <td><a href="advising.php?id='.$row['stud_id'].'"><button type="button" class="btn btn-primary">Advise</button></a></td>
                                          </tr>
                                          ';
                                    }
                                ?>
                              </tbody>
                            </table>
                            <?php
                                  $sql = "SELECT COUNT(*) AS TOTAL FROM student";
                                  $result = $conn->query($sql);
                                  $row = $result->fetch_assoc();
                                  $total = $row['TOTAL'];
                                  $numpages = $total/8;
                                  $pagenum = 8;
                                  echo '
                                      <input type="number" id="totpages" value="'.$pagenum.'" hidden>
                                      <nav aria-label="Page Navigation">
                                        <ul class="pagination">';
                                    for($i=0;$i<$numpages;$i++){
                                        if($i==0)
                                            echo '<li class="active" id="page-'.$i.'"><a href="#" onclick="pagina('.$i.',3,0,'.$pagenum.')">'.($i+1).'</a></li>';
                                        else
                                            echo '<li class="" id="page-'.$i.'"><a href="#" onclick="pagina('.$i.',3,'.$pagenum.','.($pagenum = $pagenum+$pagenum).')">'.($i+1).'</a></li>';
                                    }
                                  echo '
                                        </ul>
                                      </nav>
                                      ';
                                ?>
                          </div>
                    </div>
                  </div>
            </div>
          </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>