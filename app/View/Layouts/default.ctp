<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
            echo $this->Html->meta('icon');

            echo $this->Html->css('cake.generic');
            echo $this->Html->css('../js/jquery-ui-1.11.2/jquery-ui.min');
            echo $this->Html->css('style');

            echo $this->fetch('meta');
            echo $this->fetch('css');
        ?>
        <script>var BASE_URL = '<?php echo $this->Html->url('/'); ?>';</script>
        <?php
            echo $this->fetch('script');
            echo $this->Html->scriptBlock('var jsVars = '.$this->Js->object($jsVars).';');
         ?>
</head>
<body>
	<div id="container">
		<div id="header">
                    <nav>
                            <ul>
                                    <li><?php echo $this->Html->link('Начало', array('controller' => 'pages', 'action' => 'home')); ?></li>
        <!--                            <li>
                                            <a href="products.html">Products <span class="caret"></span></a>
                                            <div>
                                                    <ul>
                                                            <li><a href="products.html#chair">Chair</a></li>
                                                            <li><a href="products.html#table">Table</a></li>
                                                            <li><a href="cooker.html">Cooker</a></li>
                                                    </ul>
                                            </div>
                                    </li>-->
                                    <li><?php echo $this->Html->link('Поръчки', array('controller' => 'Orders', 'action' => 'index')); ?></li>
                                    <li><?php echo $this->Html->link('Служители', array('controller' => 'Employees', 'action' => 'index')); ?></li>
                                    <li><?php echo $this->Html->link('Видове услуги', array('controller' => 'ServiceTypes', 'action' => 'index')); ?></li>
                                    <?php 
                                        if ($loggedIn) {
                                    ?>
                                    <li><?php echo $this->Html->link('Изход', array('controller' => 'Users', 'action' => 'logout')); ?></li>
                                    <?php
                                        }
                                    ?>
                                    
                            </ul>
                    </nav>
		</div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">

		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
