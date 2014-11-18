<div class="service_types form">
<?php echo $this->Form->create('ServiceType'); ?>
    <fieldset>
        <legend><?php echo __('Редактирайте услугата'); ?></legend>
        <?php echo $this->Form->input('name'); ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>