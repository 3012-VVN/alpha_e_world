<div class="card card-user">
              <div class="image">
                <img src="../assets/img/damir-bosnjak.jpg" alt="...">
              </div>
              <div class="card-body">
              <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="<?php echo $UserInfo['profileurl']; ?>" alt="...">
                    <h5 class="title"><?php echo $UserInfo['firstname']." ".$UserInfo['lastname']; ?></h5>
                  </a>
                 <p class="description">
                    @<?php echo $UserInfo['username']; ?>
                  </p>
                </div>
                <p class="description text-center">
                  <?php
                    echo $quote[rand(0,count($quote)-1)]; 
                  ?>
                </p>
              </div>
             
            </div>