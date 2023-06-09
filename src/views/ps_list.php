<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phonesohp Page</title>
    <!-- Link Bootstrap5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./src/views/style.css">
    
    <style>
      .flex-box{
        display:flex;
      }
    </style>
</head>
<body>
    <br>
    <div class="container">
        <br>
        <h6 class="text-center">Nakhonpathom Rajaphat University</h6>
        <form action="?route=search" method="POST">
            <br>
            <input class="form-control text-sm" name="search_keyword" type="text" placeholder="Search">
            <div class="d-sm-flex justify-content-between text-sm m-1">
                <p><b>Note :</b> คุณสามารถค้นหารายชื่อนักศึกษาที่คุณต้องการ !</p>
                <input class="btn btn-sm btn-primary" value="Search" name="search_submit" type="submit">
            </div>
        </form>
        <div class="row"> 
        <?php
            if($result > 0){
                foreach($result as $row){ 
        ?>      

              <div class="card mb-3 m-1" style="max-width: 25rem;">
              <div class="flex-box card-header bg-transparent border-secondary">
                  <img src="<?=$row['img']?>" style="margin-right:5px;" width="80px" height="100px" alt="">
                        <div class="blox">
                        <p class="card-text"><b> ชื่อ-สกุล : </b> <?= $row['name']?></p>
                        <p class="card-text"><b> รหัสนักศึกษา : </b> <?= $row['student_id'] ?></p>
                        </div>
              </div> 
              <div class="card-body text-dark">
                        <p class="card-text"><b>สาขา : </b> <?= $row['major'] ?></p>
                        <p class="card-text"><b>เลขประจำตัว : </b> <?= $row['number_id'] ?></p>
                        <p class="card-text"><b>วัน-เดือน-ปี เกิด : </b> <?= $row['brith_day'] ?></p>
                        <p class="card-text"><b>อายุ : </b> <?= $row['age'] ?></p>
                        <p class="card-text"><small class="text-muted"></small></p>
                        </p>
                        <a class="btn btn-danger" href="?route=delete&student_id=<?=$row['student_id']?>" onclick="return confirm('คุณต้องการลบ นักเรียนคนนี้ใช่หรือไม่?')">Delete</a>
                        <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit_modal<?= $row['student_id']?>" data-bs-whatever="@getbootstrap">Edit</a>

                  <div class="modal fade" id="edit_modal<?= $row['student_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                        <button type="button" class="btn-close disabled" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="?route=edit" method="POST" enctype="multi-part/form-data">
                          <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="recipient-name" name="name" value="<?= $row['name']?>">
                          </div>
                          <div class="mb-3">
                            <label for="message-text" class="col-form-label">Major:</label>
                            <input type="text" class="form-control" id="message-text" value="<?= $row['major']?>" name="major"></input>
                          </div>
                          <div class="mb-3">
                            <label for="message-text" class="col-form-label">Number ID:</label>
                            <input type="number" class="form-control" id="message-text" value="<?= $row['number_id']?>" name="number_id"></input>
                          </div>
                          <div class="mb-3">
                            <label for="message-text" class="col-form-label">Brith Day:</label>
                            <input type="date" class="form-control" id="message-text" value="<?= $row['brith_day']?>" name="brith_day"></input>
                          </div>
                          <div class="mb-3">
                            <label for="message-text" class="col-form-label">Age:</label>
                            <input type="number" class="form-control" id="message-text" value="<?= $row['age']?>" name="age"></input>
                          </div>
                          <div class="mb-3">
                            <label for="message-text" class="col-form-label">Img:</label>
                            <input type="text" class="form-control" id="message-text" value="<?= $row['img']?>" name="img"></input>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="submit_edit">Submit Edit</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
        <?php
                }

            }
            
        ?>
        </div>


      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">New message</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="?route=add" method="POST" enctype="multi-part/form-data">
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Name:</label>
                  <input type="text" class="form-control" id="recipient-name" name="name">
                </div>
                <div class="mb-3">
                  <label for="message-text" class="col-form-label">Student ID:</label>
                  <input type="number" class="form-control" id="message-text" name="student_id"></input>
                </div>
                <div class="mb-3">
                  <label for="message-text" class="col-form-label">Major:</label>
                  <input type="text" class="form-control" id="message-text" name="major"></input>
                </div>
                <div class="mb-3">
                  <label for="message-text" class="col-form-label">Number ID:</label>
                  <input type="number" class="form-control" id="message-text" name="number_id"></input>
                </div>
                <div class="mb-3">
                  <label for="message-text" class="col-form-label">Brith Day:</label>
                  <input type="date" class="form-control" id="message-text" name="brith_day"></input>
                </div>
                <div class="mb-3">
                  <label for="message-text" class="col-form-label">Age:</label>
                  <input type="number" class="form-control" id="message-text" name="age"></input>
                </div>
                <div class="mb-3">
                  <label for="message-text" class="col-form-label">Img:</label>
                  <input type="text" class="form-control" id="message-text" name="img"></input>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="submit_add">Submit Add</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

        <div class="d-grid gap-1">
          <button type="button" style="width:300px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Add student +</button>
        </div>

        <!-- Footer -->
<footer class="text-center text-lg-start bg-white text-muted mt-5">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span>Get connected with us on social networks:</span>
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
      <a href="" class="me-4 link-secondary">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="" class="me-4 link-secondary">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="" class="me-4 link-secondary">
        <i class="fab fa-google"></i>
      </a>
      <a href="" class="me-4 link-secondary">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="" class="me-4 link-secondary">
        <i class="fab fa-linkedin"></i>
      </a>
      <a href="" class="me-4 link-secondary">
        <i class="fab fa-github"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3 text-secondary"></i>Company name
          </h6>
          <p>
            Here you can use rows and columns to organize your footer content. Lorem ipsum
            dolor sit amet, consectetur adipisicing elit.
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Products
          </h6>
          <p>
            <a href="#!" class="text-reset">Angular</a>
          </p>
          <p>
            <a href="#!" class="text-reset">React</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Vue</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Laravel</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Useful links
          </h6>
          <p>
            <a href="#!" class="text-reset">Pricing</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Settings</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Orders</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Help</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fas fa-home me-3 text-secondary"></i> New York, NY 10012, US</p>
          <p>
            <i class="fas fa-envelope me-3 text-secondary"></i>
            info@example.com
          </p>
          <p><i class="fas fa-phone me-3 text-secondary"></i> + 01 234 567 88</p>
          <p><i class="fas fa-print me-3 text-secondary"></i> + 01 234 567 89</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
    © 2021 Copyright:
    <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
    </div>


</body>
</html>