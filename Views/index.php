
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
            <a href="<?php echo FRONT_ROOT ?>User/ShowRegisterView"><button>Register</button></a>
        </div>
    </section>


</main>