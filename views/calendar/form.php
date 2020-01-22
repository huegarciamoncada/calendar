<div class="form-row">
            <div class="form-group col-sm-6">
                <label for="name">Titre</label>
                <input id="name" type="text" required class="form-control" name="name" 
                value="<?= isset($data['name'])? h($data['name']) : ''; ?>">
                <?php if(isset($errors['name'])) :?>
                    <p class="help-block"><?php  echo $errors['name']; ?></p>
                <?php endif;?>
            </div>
            <div class="form-group col-sm-6">
                <label for="date">Date</label>
                <input id="date" type="date" required class="form-control" name="date" value="<?= isset($data['date'])? h($data['date']) : ''; ?>">
                <?php if(isset($errors['date'])) :?>
                    <p class="help-block"><?php  echo $errors['date']; ?></p>
                <?php endif;?>
            </div>
        </div>            
        <div class="form-row">
            <div class="form-group col-sm-6">
                <label for="start">Démarrage</label>
                <input id="start" type="time" required class="form-control" name="start" placeholder="HH:MM" value="<?= isset($data['start'])? h($data['start']) : ''; ?>">
                <?php if(isset($errors['start'])) :?>
                    <small class="form-text text-muted"><?php  echo $errors['start']; ?></small>
                <?php endif;?>
            </div>
            <div class="form-group col-sm-6">
                <label for="end">Fin</label>
                <input id="end" type="time" required class="form-control" name="end" placeholder="HH:MM" value="<?= isset($data['end'])? h($data['end']) : ''; ?>">
            </div>
        </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description"  class="form-control" name="description"><?= isset($data['description'])? h($data['description']) : ''; ?></textarea>
            </div>     