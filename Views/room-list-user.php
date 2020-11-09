<?php
require_once('nav.php');
?>

<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Room List</h2>
            <table class="table table-dark">
                <thead>
                <!--<th>Id</th>-->
                <th>Name</th>
                <th>Capacity</th>
                <th>Ticket Price</th>
                </thead>
                <tbody>

                <?php
                foreach($roomList as $room)
                {
                    ?>
                    <tr>
                        <!--<td><?php //echo $room->getId() ?></td>-->
                        <td><?php echo $room->getName() ?></td>
                        <td><?php echo $room->getCapacity() ?></td>
                        <td><?php echo $room->getRoom_price() ?></td>
                        <td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>
</main>
