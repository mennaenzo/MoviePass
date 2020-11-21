<?php
require_once VIEWS_PATH . "nav.php";
?>
<main class="">
    <section id="listado" class="mb-5">
        <form style="" id= "ticket" action="<?php echo FRONT_ROOT ?>Ticket/Add" method="post" class="bg-light-alpha p-5">
            <header class="header">
                <br>
                <br>
                <h2 style="color: black"><strong>Comprar Entrada</strong></h2>
                 <!--Método para calcular el subtotal -->
                <script>
                    function multi(){
                        m1 = document.getElementById("quantity").value;
                        m2 = document.getElementById("ticket_price").value;
                        r = m1*m2;
                        document.getElementById("subtotal").value = r;
                    }
                </script>
            </header>
            <div class="sep">
                <div class="inputs">
                    <label style="color: black" for="name"><strong>Precio Ticket</strong></label>
                    <input type="number" name="price" id ="ticket_price" value="<?php echo $ticket->getPrice();?>" class="form-control" readonly = "readonly" onChange="multi();">
                    
                    <label style="color: black" for="name"><strong>Cantidad </strong></label>
                    <input type = "number" name= "quantity" id= "quantity" class="form-control" placeholder ="<?php echo "Cantidad de entradas disponibles: ". $limit;?>"  min ="0" max ="<?php echo $limit;?>" onChange="multi();">
                    
                    <label style="color: black" for="">Subtotal</label>
                    <input type="number" name = "subtotal" id ="subtotal" value="" class="form-control" readonly="readonly">
                    <input type="hidden" name="id_show" value="<?php ?>">
                    
                    <label style="color: black" for="">Tarjeta de Credito</label>
                    <input type="text" name="credit_card" value="" class="form-control">

                    <br>
                    <button id="submit" type="submit" value = "" name="Button" class="btn btn-dark ml-auto d-block">Comprar</button>
                </div>
                <?php
                if (isset($message)) {
                    echo "<script> alert('$message'); </script>";
                }
                ?>
            </div>
        </form>
    </section>
</main>
