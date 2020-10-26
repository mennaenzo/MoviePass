<?php
///require_once('nav.php');
if(isset($message)){ echo "<script> alert('$message'); </script>"; }
?>
<main class="">
    <section id="" class="">
        <div class="">
            <h2 class="">LOGIN</h2>
            <form action="<?php echo FRONT_ROOT ?>User/Login" method="post" class="">
                <div class="">
                    <div class="">
                        <div class="">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" value="" class="" required>
                        </div>
                    </div>
                    <div class="">
                        <div class="">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" value="" class=""required>
                        </div>
                    </div>

                </div>
                <button type="submit" name="button" class="">Log</button>
            </form>
        </div>
        <br>
        <div>
            <form action="<?php echo FRONT_ROOT ?>User/ShowRegisterView" method="POST">
                <button type="submit" name="" class="" value=""> Register </button>
            </form>
        </div>
    </section>


</main>