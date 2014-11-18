<h1>Служители</h1>
<p><?php echo $this->Html->link("Добави служител", array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Име</th>
        <th>Презиме</th>
        <th>Фамилия</th>
        <th>Адрес</th>
        <th>Телефон</th>
        <th>Действия</th>
    </tr>

    <?php foreach ($employees as $employee): ?>
        <tr>
            <td><?php echo $employee['Employee']['first_name']; ?></td>
            <td><?php echo $employee['Employee']['middle_name']; ?></td>
            <td><?php echo $employee['Employee']['last_name']; ?></td>
            <td><?php echo $employee['Employee']['address']; ?></td>
            <td><?php echo $employee['Employee']['phone']; ?></td>
            <td>
            <?php
                echo $this->Html->link(
                    'Редактирай',
                    array('action' => 'edit', $employee['Employee']['id'])
                );
                echo '<br/>';
                echo $this->Form->postLink(
                    'Изтрий',
                    array('action' => 'delete', $employee['Employee']['id']),
                    array('confirm' => 'Сигурен ли си, че искаш да изтриеш този работник?')
                );
            ?>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php unset($employee); ?>
</table>