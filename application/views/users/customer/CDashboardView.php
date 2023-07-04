<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>


  <!-- CDN of datatables -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

  <link rel="shortcut icon" href="<?php echo base_url()?>images/favicon1.ico" type="image/x-icon">

    <title>Bookro | Customer</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        body {
            background-color: #e3f2fd;

}

/* Hide the vertical scrollbar */
body::-webkit-scrollbar {
width: 0;
background: transparent;
}

        .nav-item {
            padding: 0px 15px;
        }
    </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #1f2833;">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">Bookro</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white"href="<?php echo base_url().'index.php/users/HomePageCont/index';?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?php echo base_url().'index.php/users/HomePageCont/aboutUs'; ?>">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?php echo base_url().'index.php/users/ContactUs';?>">Contact Us</a>
                </li>
            </ul>
                
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active text-white" href="#">Welcome <?php $userArray = $this->session->userdata('user'); echo $userArray['name'];?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?php echo base_url().'index.php/users/customer/CLogContro/logout' ?>">LogOut</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- to show notification to the customer -->
<!-- <div id="notification"><?php
//  echo $this->session->flashdata('notification');
  ?></div> -->

<?php 
  $message = $this->session->flashdata('message');
  if ($message == "success") {
?>
    <script type="text/javascript">
       $(document).ready(function(){
        $.notify({
            icon: 'fa fa-check-circle',
            message: "Success <b>Entry Database</b>."
        },{
            type: 'info',
            timer: 4000
        });
     });
   </script>
<?php 
  }
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col">
          <h1 class="m-0 text-center mt-3">Book a ride here</h1>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="row justify-content-center mt-3">
  <div class="col-md-4">
    <form action="<?php echo base_url().'index.php/users/customer/CDashboardCont/saveRequest';?>" method="POST">
      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>

      <div class="mb-3">
        <label for="mobile" class="form-label">Mobile Number</label>
        <input type="text" class="form-control" id="mobile" name="mobile" maxlength="10" pattern="^[6-9][0-9]*$" required oninput="if(!this.value.match('^[6-9][0-9]*$'))this.value='';">  
      </div>  
      
      <div class="mb-3">
        <label for="boarding" class="form-label">Address: Boarding</label>
        <input type="text" class="form-control" id="boarding" name="boarding" required>
      </div>  

      <div class="mb-3">
        <label for="destination" class="form-label">Destination</label>
        <input type="text" class="form-control" id="destination" name="destination" required>
      </div> 

      <div class="text-center">
        <button type="submit" class="btn btn-primary mt-3">Request</button>
      </div>
    </form>
  </div>
</div>
<div class ="text-center mt-3">
<a href="<?php echo base_url(). 'index.php/users/customer/CDashboardCont/completed';?>">
  <button class='btn btn-success mb-2'>Completed</button>
</a>
</div>


<hr>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col">
          <h1 class="m-0 text-center">Pending Rides</h1>
        </div>
      </div>
    </div>
  </div>
</div>

<hr>

<!-- Main content -->
<div class="container">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Name</th>
          <th scope="col">Mobile Num</th>
          <th scope="col">Boarding</th>
          <th scope="col">Destination</th>
          <th scope="col">Status</th>
          <!-- <th scope="col">Pay</th> -->
        </tr>
      </thead>
      <tbody>
        <?php
        $slno = 0;
        foreach ($status as $stat){
          $slno = $slno + 1;
          $statslno = $stat->slno;
          $invoice = site_url("users/customer/CDashboardCont/seeInvoice/$statslno") ;

          echo "<tr>
                  <th scope='row'>". $slno . "</th>
                  <td>". $stat->name . "</td>
                  <td>". $stat->mobile . "</td>
                  <td>". $stat->boarding . "</td>
                  <td>". $stat->destination . "</td>
                  <td>". $stat->status . "</td>
                  </tr>";
                } 
                
                ?>
      <!-- <td>
        <a href='$invoice'><button class='invoice btn btn-info btn-sm'>Invoice</button></a>
      </td> -->
      </tbody>
    </table>
  </div>
  <!-- /.content-wrapper -->
</div>

<footer class="main-footer text-center mt-5">
    <!-- Default to the left -->
    <strong>Copyright &copy; 2023 Bookro.com</strong>
    All rights reserved.
</footer>

<!-- the cdn of jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>

</body>
</html>