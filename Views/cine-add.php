<?php
    require_once('nav.php');
?>
<main class="py-auto">
     <section id="listado" class="mb-5">
              <form id= "signup" action="<?php echo FRONT_ROOT ?>Cinema/Add" method="post" class="bg-light-alpha p-5">
                  <header class="header">
                      <br>
                      <br>
                      <h2>Add Cinema</h2>
                  </header>
                  <div class="sep"></div>
                         <div class="inputs">

                            <label for="name">Name</label>
                            <input type="text" name="cinema_name" value="" class="form-control" required>

                            <label for="address">Address</label>
                            <input type="text" name="cinema_address" value="" class="form-control" required>

                           <!--   <label for="ticketPrice">Ticket Price</label>
                             <input type="number" name="ticket_price" value="" class="form-control" required>
                             
                             <label for="numberOfRoom">Number of Room</label>
                             <input type="number" name="number_room" value="" class="form-control" required>
                             
                             <label for="numberOfSeats">Number of Seats</label>
                             <input type="number" name="number_seats" value="" class="form-control" required>
                              -->
                             <br>
                            
                            <button id="submit" type="submit" name="button" class="btn btn-dark ml-auto d-block">Add Room</button>
                         </div>
                         <?php 
                            if(isset($message)){  
                                echo "<script> alert('$message'); </script>";
                            }                      
                        ?> 
              </form>
          </div>
     </section>

</main>


