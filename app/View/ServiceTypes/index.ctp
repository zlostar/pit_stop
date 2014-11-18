<h1>Видове услуги</h1>
<p><?php echo $this->Html->link("Добави услуга", array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Име</th>
        <th>Действия</th>
    </tr>
    <?php foreach ($service_types as $service_type): ?>
        <tr>
            <td><?php echo $service_type['ServiceType']['name']; ?></td>
            <td>
            <?php
                echo $this->Html->link(
                    'Редактирай',
                    array('action' => 'edit', $service_type['ServiceType']['id'])
                );
                echo '<br/>';
                echo $this->Form->postLink(
                    'Изтрий',
                    array('action' => 'delete', $service_type['ServiceType']['id']),
                    array('confirm' => 'Сигурен ли си, че искаш да изтриеш тази услуга?')
                );
            ?>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php unset($service_type); ?>
</table>