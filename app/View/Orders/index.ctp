<h1>Поръчки</h1>
<p><?php echo $this->Html->link("Добави поръчка", array('action' => 'add')); ?></p>
<div class="datepicker"></div>
<div>
    <table>
    <tr>
        <th>Име на клиента</th>
        <th>Кола</th>
        <th>Регистационен номер</th>
        <th>Телефон</th>
        <th>Действия</th>
        <th>Дата</th>
    </tr>
    
    <?php foreach ($orders as $order): ?>
        <tr>
            <td><?php echo $order['Order']['client_name']; ?></td>
            <td><?php echo $order['Order']['car']; ?></td>
            <td><?php echo $order['Order']['car_reg_plate']; ?></td>
            <td><?php echo $order['Order']['client_phone']; ?></td>
            <td>
            <?php
                echo $this->Html->link(
                    'Виж',
                    array('action' => 'view', $order['Order']['id'])
                );
                echo '<br/>';
                echo $this->Html->link(
                    'Редактирай',
                    array('action' => 'edit', $order['Order']['id'])
                );
                echo '<br/>';
                echo $this->Form->postLink(
                    'Изтрий',
                    array('action' => 'delete', $order['Order']['id']),
                    array('confirm' => 'Сигурен ли си, че искаш да изтриеш тази поръчка?')
                );
            ?>
            </td>
            <td><?php echo $order['Order']['created']; ?></td>
            
        </tr>
    <?php endforeach; ?>
    <?php unset($order); ?>
</table>
</div>


<?php 
    echo $this->Html->script(array('jquery-2.1.1.min', 'jquery-ui-1.11.2/jquery-ui.min', 'orders/index'));