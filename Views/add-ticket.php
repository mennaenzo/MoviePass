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
           
                <script>    
                    //Método para calcular el subtotal 
                    function multi(){
                        m1 = document.getElementById("quantity").value;
                        m2 = document.getElementById("ticket_price").value;
                        r = m1*m2;
                        document.getElementById("subtotal").value = r;
                    }

                    //Método para calcular el total
                     function discount(){
                        m1 = document.getElementById("quantity").value;
                        m2 = document.getElementById("ticket_price").value;
                        d = document.getElementById("price2").value;
                         if(m1 >= 2){
                           m2 = (document.getElementById("ticket_price").value) - d;
                        } 
                         r = m1*m2;
                        document.getElementById("total").value = r;
                    }
                </script>
            </header>
            <div class="sep">
                <div class="inputs">
                    <label style="color: black" for="name"><strong>Precio Ticket</strong></label>
                    <input type="number" name="price" id ="ticket_price" value="<?php echo $ticket->getPrice();?>" class="form-control" readonly = "readonly" onChange="multi(); discount();">
                    
                    <label style="color: black" for="name"><strong>Cantidad </strong></label>
                    <input type = "number" name= "quantity" id= "quantity" class="form-control" placeholder ="<?php echo "Cantidad de entradas disponibles: ". $limit;?>"  min ="0" max ="<?php echo $limit;?>" onChange="multi(); discount();">
                    
                    <label style="color: black" for="">Subtotal</label>
                    <input type="number" name = "subtotal" id ="subtotal" value="" class="form-control" readonly="readonly">
                    <input type="hidden" name="id_show" value="<?php echo  $ticket->getShow()->getId(); ?>">
                    
                    <input type="text" name="price2" id="price2" value="<?php echo $discount;?>" readonly = "readonly">
                    <label style="color: black" for="">Total</label>
                    <input type="number" name = "total" id ="total" value="" class="form-control" readonly="readonly">
                    
                    <input type="hidden" name="idUser" value="<?php echo $user; ?>">
                    
                    <label style="color: black" for="lblCreditCard">Tarjeta de Credito</label>
                    <select name="creditCard">
                        <option value="Visa">Visa</option>
                        <option value="Mastercard">MasterCard</option>
                    </select>
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
