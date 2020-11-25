<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 style="color: whitesmoke" class="mb-4">Listado de Cines</h2>
            <table class="table table-dark">
                <thead>
                <th>Name</th>
                <th>Address</th>
                <th>Rooms</th>

                </thead>
                <tbody>

                <?php
                foreach($cinemaList as $cinema)
                {
                    ?>
                    <tr>
                        <td><?php echo $cinema->getName() ?></td>
                        <td><?php echo $cinema->getAddress() ?></td>
                        <td>
                            <form action="<?php echo FRONT_ROOT ?>Room/ShowRoomListView_User" method="POST">
                                <button type="submit" formmethod="POST" name="btnSeeRoom" class="btn btn-danger" value="<?php echo $cinema->getId()?>"> Rooms </button>
                            </form>
                        </td>

                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>
</main>