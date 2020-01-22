{
    "phpcs.executablePath": "/home/hue/.config/composer/vendor/bin/phpcs",
    "php.suggest.basic": false,
    "php.validate.enable": false,
    "emmet.excludeLanguages": [
        "markdown",
        "php"
    ],
    "phpcs.standard": "WordPress"
    
}


<?= $month->getWeeks();?>
<li>Heure de fin: <?= (new \DateTime($event['end']))->format('H:i'); ?></li>

<h1><?= h($event->getName()); ?></h1>
<ul>
    <li>Date: <?= ($event->getStart())->format('d/m/Y'); ?></li>
    <li>Heure de démarrage: <?= ($event->getStart())->format('H:i'); ?></li>
    <li>Heure de fin: <?= ($event->getEnd())->format('H:i'); ?></li>
    <li>Description: <br> 
    <?= h($event->getDescription()); ?></li>

</ul>

<div class="row">
            <div class="sol-sm-6">
                <div class="form-control">
                    <label for="name">Titre</label>
                    <input id="name" type="text" class="form-control" name="name">
                </div>
            </div>
            <div class="sol-sm-6">
                <div class="form-control">
                    <label for="date">Date</label>
                    <input id="date" type="date" class="form-control" name="date">
                </div>
            </div>
        </div>
<!-- <div class="row">
            <div class="sol-sm-6">
                <div class="form-control">
                    <label for="name">Titre</label>
                    <input id="name" type="text" class="form-control" name="name">
                </div>
            </div>
            <div class="sol-sm-6">
                <div class="form-control">
                    <label for="date">Date</label>
                    <input id="date" type="date" class="form-control" name="date">
                </div>
            </div>
        </div>-->
        <?php render('calendar/form', ['data' =>$data, 'errors'=>$errors]); ?>   
        
        <?php
                //isset($data['description'])? h($data['description']) : ''; 
                //$data['description'];
                echo "test description";
                ?>
 <a class="calendar__day" href="/calendar/public/add.php?date=<?= $date->format('Y-m-d'); ?>"><?= $date->format('d'); ?></a>