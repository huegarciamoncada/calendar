<?php
require '../src/bootstrap.php';
$pdo = getPdo();
$events = new Calendar\Events($pdo);
$errors = [];
if (!isset($_GET['id'])) {
    header('location: /calendar/public/404.php');
}

try {
    $event = $events->find($_GET['id']);
} catch (\Exception $e) {
    e404();
   
}
$data = [
    'id' => $event->getId(),
    'name' => $event->getName(),
    'date' => $event->getStart()->format('Y-m-d'),
    'start' => $event->getStart()->format('H:i'),
    'end' => $event->getEnd()->format('H:i'),
    'description' => $event->getDescription()  
];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;    
    $validator = new Calendar\EventValidator();
    $errors = $validator->validates($_POST);
    if (empty($errors)) {
        
        $event->setName($data['name']);
        $event->setDescription($data['description']);
        $event->setStart(DateTime::createFromFormat('Y-m-d H:i', $data['date']. ' ' .$data['start'])
        ->format('Y-m-d H:i:s'));
        $event->setEnd(DateTime::createFromFormat('Y-m-d H:i', $data['date']. ' ' .$data['end'])
        ->format('Y-m-d H:i:s'));
        
        $events->update($event);      

        header('Location: /calendar/public/index.php?success=1');
        exit();
    }
   
}
render('header', ['title' => $event->getName()]);
?>
<div class="container">
    <h1>Editer l'évènement <small><?= h($event->getName()); $event->getStart();?></small></h1>
    <form action="" method="post" class="form">  
    <?php render('calendar/form', ['data' =>$data, 'errors'=>$errors]); ?>             
       
        <div class="form-group">
                <button class="btn btn-primary">Modifier l'évènement</button>               
            </div>
                        
    </form>
    <div class="col-md-3"><a class="btn btn-primary" href="/calendar/public/delete.php?id=<?php echo $data['id']; ?>" name="delete"  onclick="return confirm('Vous voulez supprimer?');" role="button">Supprimer</a></div>  

</div>

<?php render('footer'); ?>