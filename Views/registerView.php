<main class="p">
    <section id="" class="">
        <div class="">
            <h2 class="">Register Form</h2>
               <form action="<?php echo FRONT_ROOT ?> User/Add" method="post" class="">
                    <div class="">
                         <div class="">
                              <div class="">
                                   <label for="name">Name</label>
                                   <input type="text" id="name" name="name" value="" class="" placeholder="Name" required>
                              </div>
                         </div>
                         <div class="">
                              <div class="">
                                   <label for="lastName">Last Name</label>
                                   <input type="text" id="lastName" name="lastName" value="" class="" placeholder="Last Name" required>
                              </div>
                         </div>
                         <div class="">
                              <div class="">
                                   <label for="email">Email</label>
                                   <input type="email" id="email" name="email" value="" class="" placeholder="Email" required>
                              </div>
                         </div>

                    <div class="">
                              <div class="">
                                   <label for="password">Password</label>
                                   <input type="password" id="password" name="password" value="" class="" placeholder="Password" required>
                              </div>
                         </div>
                    </div>

                    <button type="submit" name="button" class="">Register</button>
               </form>

               <a href="<?php echo FRONT_ROOT ?>User/ShowLoginView"><button>Cancel</button></a>

            <?php  if(isset($message)){ echo "<script> alert('$message'); </script>"; }
            ?>
          </div>
     </section>

</main>

