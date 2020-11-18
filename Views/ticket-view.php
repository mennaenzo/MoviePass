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
            </header>
            <div class="sep">
                <div class="inputs">
                    <label style="color: black" for="name"><strong>Precio Ticket</strong></label>
                    <input type="int" name="price" id ="ticket_price" value="<?php ?>" class="form-control" readonly = "readonly" onChange="multi();">
                    <label style="color: black" for="name"><strong>Cantidad</strong></label>
                    <select name="quantity" id= "quantity" class="form-control" onChange="multi();" required>
                        <?php for ($i = 0; $i<11 ; $i++){ ?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php
                        }?>
                    </select>
                    <label style="color: black" for="">Subtotal</label>
                    <input type="number" name = "subtotal" id ="subtotal" value="0" class="form-control" readonly="readonly">
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
