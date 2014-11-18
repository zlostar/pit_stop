<div class="employees form">
<?php echo $this->Form->create('Employee'); ?>
    <fieldset>
        <legend><?php echo __('Добавете работник'); ?></legend>
        <?php echo $this->Form->input('first_name'); 
         echo $this->Form->input('middle_name'); 
         echo $this->Form->input('last_name'); 
         echo $this->Form->input('address'); 
         echo $this->Form->input('phone'); 
         foreach ($service_types as $service_type) { 
            echo $this->Form->input($service_type['ServiceType']['name'], array('name' => 'service_type_'.$service_type['ServiceType']['id'],'placeholder' => 'Заплащане в проценти')); 
         } ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>