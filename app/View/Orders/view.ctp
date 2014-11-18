<div class="orders">
        <?php
            echo 'Дата - ' . $order['Order']['created'];
        ?>
        <table>
            <tbody>
                <tr>
                    <th colspan="2"><h2>Данни за автомобила</h2></th>
                    <th></th>
                    <th colspan="2"><h2>Данни за клиента</h2></th>
                </tr>
                <tr>
                    <td>Регистрационен номер</td>
                    <td><?php echo $car['Car']['registration_plate']; ?></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>Име</td>
                    <td><?=$client['Client']['name']; ?></td>
                </tr>
                <tr>
                    <td>Марка</td>
                    <td><?php echo $car['Car']['make']; ?></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>Държава</td>
                    <td><?php echo $client['Client']['country']; ?></td>
                </tr>
                <tr>
                    <td>Модел</td>
                    <td><?php echo $car['Car']['model']; ?></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>Град</td>
                    <td><?php echo $client['Client']['city']; ?></td>
                </tr>
                <tr>
                    <td>Изминати километри</td>
                    <td><?php echo $car['Car']['mileage']; ?></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>Улица</td>
                    <td><?php echo $client['Client']['street']; ?></td>
                </tr>
                <tr>
                    <td>Други данни</td>
                    <td><?php echo $car['Car']['description']; ?></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>Номер</td>
                    <td><?php echo $client['Client']['street_number']; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>&nbsp;</td>
                    <td>Телефон</td>
                    <td><?php echo $client['Client']['phone']; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>Електронна поща</td>
                    <td><?php echo $client['Client']['email']; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>Фирма</td>
                    <td><?php echo (($client['Client']['is_company']) ? 'Да' : 'Не'); ?></td>
                </tr>
                <?php if ($client['Client']['is_company']) { ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>Материално отговорно лице (МОЛ)</td>
                    <td><?php echo $client['Client']['mol']; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>Булстат</td>
                    <td><?php echo $client['Client']['bulstat']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        
        <h2>Извършени услуги</h2>
	<table id="services">
            <tbody>
                <tr>
                    <th>Ремонтна дейност</th>
                    <th>Бригада</th>
                    <th>Брой</th>
                    <th>Единична цена без ДДС</th>
                    <th>Единична цена</th>
                    <th>Общо</th>
                    
                <?php
                $totalPrice = 0;
                foreach ($services as $service):
                    $rowPrice = $service['Service']['price'] * $service['Service']['count'];
                    $priceDDS = $this->requestAction('App/calculateDDS/'.$rowPrice);
                    $totalPrice = $totalPrice + $priceDDS;
                ?>
                <tr>
                    <td><?php echo $service['Service']['description']; ?></td>
                    <td>
                        <?php
                            foreach ($service['PerformedBy'] as $employee) {
                                echo $employee['first_name'] . ' ' . $employee['middle_name'] . ' ' . $employee['last_name'] . ' - ' . $employee['phone'] . '</br>';
                            }
                        ?>
                    </td>
                    <td><?php echo $service['Service']['count']; ?></td>
                    <td><?php echo $service['Service']['price']; ?></td>
                    <td><?php echo $priceDDS; ?></td>
                    <td><?php echo $totalPrice; ?></td>
                </tr>
                <?php endforeach; ?>
                <tr><td colspan="6">&nbsp;</td></tr>
                <tr>
                    <td colspan="4">&nbsp;</td>
                    <td><strong>Общо</strong></td>
                    <td><?php echo $totalPrice; ?></td>
                </tr>
                
            </tbody>
	</table>
        
        <h2>Вложени части</h2>
        <table id="parts">
            <tbody>
                <tr>
                    <th>Вложени части</th>
                    <th>Брой</th>
                    <th>Единична цена</th>
                    <th>Общо</th>
                </tr>
                <?php
                $totalPartsPrice = 0;
                foreach ($parts as $part):
                    $rowPartsPrice = $part['Part']['price'] * $part['Part']['count'];
                    $totalPartsPrice = $totalPartsPrice + $rowPartsPrice;
                ?>
                <tr>
                    <td><?php echo $part['Part']['description']; ?></td>
                    <td><?php echo $part['Part']['count']; ?></td>
                    <td><?php echo $part['Part']['price']; ?></td>
                    <td><?php echo $rowPartsPrice;?></td>
                </tr>
                <?php endforeach; ?>
                <tr><td colspan="4">&nbsp;</td></tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                    <td><strong>Общо</strong></td>
                    <td><?php echo $totalPartsPrice; ?></td>
                </tr>
            </tbody>
	</table>
        
        <h2>Забележка</h2>
        <?php
            echo $order['Order']['description'];
        ?>
</div>