<div class="orders form">
<?php echo $this->Form->create('Order'); ?>
    <fieldset>
        <legend><?php echo __('Добавете поръчка'); ?></legend>
        <?php
            echo $this->Form->input('Дата', array('name' => 'order_created', 'class' => 'datepicker', 'id' => false));
        ?>
        <div>
            <div class="order_car">
                <h2>Данни за автомобила</h2>
                <?php
                    echo $this->Form->input('Регистрационен номер', array('name' => 'car_registration_plate', 'id' => 'car_registration_plate'));
                    echo $this->Form->input('Марка', array('name' => 'car_make', 'id' => false));
                    echo $this->Form->input('Модел', array('name' => 'car_model', 'id' => false));
                    echo $this->Form->input('Изминати километри', array('name' => 'car_mileage', 'id' => false));
                    echo $this->Form->input('Други данни', array('name' => 'car_description', 'id' => false));
                ?>
            </div>
            <div class="order_client">
                <h2>Данни за клиента</h2>
                <?php
                    echo $this->Form->input('Име', array('name' => 'client_name', 'id' => false));
                    echo $this->Form->input('Държава', array('name' => 'client_country', 'id' => false));
                    echo $this->Form->input('Град', array('name' => 'client_city', 'id' => false));
                    echo $this->Form->input('Улица', array('name' => 'client_street', 'id' => false));
                    echo $this->Form->input('Номер', array('name' => 'client_street_number', 'id' => false));
                    echo $this->Form->input('Телефон', array('name' => 'client_phone', 'id' => false));
                    echo $this->Form->input('Електронна поща', array('name' => 'client_email', 'id' => false));
                    echo $this->Form->input('Фирма', array('type' => 'checkbox', 'name' => 'client_is_company', 'class' => 'is_company', 'id' => false));
                    echo $this->Form->input('Материално отговорно лице (МОЛ)', array('name' => 'client_mol', 'disabled' => 'disabled', 'class' => 'company', 'label' => array('class' => 'company_label'), 'id' => false));
                    echo $this->Form->input('Булстат', array('name' => 'client_bulstat', 'disabled' => 'disabled', 'class' => 'company', 'label' => array('class' => 'company_label'), 'id' => false));
                ?>
            </div>
            <div class="clear"></div>
        </div>
        
        <h2>Извършени услуги</h2>
	<table id="services">
            <tbody>
                <tr>
                    <th></th>
                    <th>Ремонтна дейност</th>
                    <th>Бригада</th>
                    <th>Брой</th>
                    <th>Цена</th>

                <tr id="service0" style="display:none;">
                        <td><div><?php echo $this->Form->button('&nbsp;-&nbsp;',array('type'=>'button','title'=>'Цъкни тук за да изтриеш тази ремонтна дейност', 'class' => 'remove_service')); ?></div></td>
                        <td><?php echo $this->Form->input('service_description', array('name' => 'service_description', 'label' => false, 'id' => false)); ?></td>
                        <td>
                            <div>
                                <?php
                                echo $this->Form->input(
                                    'services_employees',
                                    array('options' => $employees_select, 'default' => '', 'label' => false, 'div' => false, 'id' => false)
                                );
                                echo '&nbsp;&nbsp;&nbsp';
                                echo $this->Form->button('Добави',array('type'=>'button','title'=>'Цъкни тук за да добавиш този работник', 'class' => 'add_employee', 'id' => false));
                                ?>
                            </div>
                        </td>
                        <td><?php echo $this->Form->input('service_count', array('name' => 'service_count', 'label' => false, 'id' => false)); ?></td>
                        <td><?php echo $this->Form->input('service_price', array('name' => 'service_price', 'label' => false, 'id' => false)); ?></td>
                </tr>
                <tr id="trAdd">
                    <td> <div><?php echo $this->Form->button('+',array('type'=>'button','title'=>'Цъкни тук за да добавиш ремонтна дейност','onclick'=>'addService()')); ?></div> </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
	</table>
        
        <h2>Вложени части</h2>
        <table id="parts">
            <tbody>
                <tr>
                    <th></th>
                    <th>Вложени части</th>
                    <th>Брой</th>
                    <th>Цена</th>

                <tr id="part0" style="display:none;">
                    <td><div><?php echo $this->Form->button('&nbsp;-&nbsp;',array('type'=>'button','title'=>'Цъкни тук за да изтриеш тази част')); ?></div></td>
                        <td><?php echo $this->Form->input('', array('name' => 'part_description', 'id' => false)); ?></td>
                        <td><?php echo $this->Form->input('', array('name' => 'part_count', 'id' => false)); ?></td>
                        <td><?php echo $this->Form->input('', array('name' => 'part_price', 'id' => false)); ?></td>
                </tr>
                <tr id="trAdd">
                    <td> <div><?php echo $this->Form->button('+',array('type'=>'button','title'=>'Цъкни тук за да добавиш част','onclick'=>'addPart()')); ?></div> </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
	</table>
        
        <h2>Забележка</h2>
        <?php
            echo $this->Form->textarea('description', array('name' => 'order_description'));
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php 
    echo $this->Html->script(array('jquery-2.1.1.min', 'jquery-ui-1.11.2/jquery-ui.min', 'orders/add'));

