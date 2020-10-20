<?php
    require_once('nav.php');



?>
<main class="py-auto">
    <br>
    <br>
    <h2 class="miEstilo">Movie Pass</h2>
    <h2 class="miEstilo">Add Cinema</h2>
     <section id="listado" class="mb-5">
              <form id= "signup" action="<?php echo FRONT_ROOT ?>Cinema/Add" method="post" class="bg-light-alpha p-5">
                  <header class="header">
                      <br>
                      <br>
                      <h2>Add Cinema</h2>
                  </header>
                  <div class="sep"></div>
                         <div class="inputs">

                             <label for="">Name</label>
                             <input type="text" name="cinema_name" value="" class="form-control" required>

                             <label for="">Address</label>
                             <input type="text" name="cinema_address" value="" class="form-control" required>

                             <label for="">Capacity</label>
                             <input type="int" name="cinema_capacity" value="" class="form-control" required>

                             <label for="">Ticket Price</label>
                             <input type="number" name="ticket_price" value="" class="form-control" required>
                             <br>
                             <button id="submit" type="submit" name="button" class="btn btn-dark ml-auto d-block">Add</button>

                         </div>
              </form>
          </div>
     </section>

</main>


