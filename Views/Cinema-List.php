<?php
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de Cines</h2>
            <table class="table bg-light-alpha">
                <thead>

                <th>Name</th>
                <th>Address</th>
                <th>Ticket Price</th>
                </thead>
                <tbody>
                    <tr>
                    <?php foreach($cinemaList as $cinema){ ?>
                        <td><?php echo $cinema->getName() ?></td>
                        <td><?php echo $cinema->getAddress() ?></td>
                        <td><?php echo $cinema->getTicketPrice() ?></td>
                        <td>
                            <form action="<?php echo FRONT_ROOT ?>Cinema/Delete" method="POST">
                                <button type="submit" name="btnRemove" class="btn btn-danger" value=""> Eliminar </button>
                            </form>
                        </td>
                        <td>
                            <form action="<?php echo FRONT_ROOT ?>Cinema/ViewModify" method="POST">
                                <button type="submit" name="btnModify" class="btn btn-danger" value=""> Modificar </button>
                            </form>
                        </td>
                    </tr>
                    <?php 
                        }
                        if(isset($message)){ 
                            echo "<script> alert('$message'); </script>";
                        }
                    ?> 
                </tbody>
            </table>
        </div>
    </section>
</main>

