<div class="content-mid">
    <h1>Rohdaten</h1>
    <form method="POST">
        <div class="form-group">
            <label for="id">Zähler</label>
            <select class="form-control" id="id" name="id">
                <?php foreach($data["zaehler"] as $zaehler): ?>
                    <option value="<?php echo $zaehler["id"]; ?>"><?php echo $zaehler["name"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="start">Startpunkt</label>
            <input type=datetime-local class="form-control" id="start" name="start" value="<?= $data["starttime"]?>">
        </div>
        <div class="form-group">
            <label for="end">Endpunkt</label>
            <input type=datetime-local class="form-control" id="end" name="end" value="<?= $data["endtime"]?>">
        </div><br>
        <button type="submit" class="btn btn-primary">Daten holen</button>
    </form>
    <?php 
        if($data["daten"] != null){
            ?>
            <table class="table table-striped">
                <tr>
                    <th>Zeit</th>
                    <th>Wert</th>
                </tr>
                <?php foreach($data["daten"] as $daten): ?>
                    <tr>
                        <td><?php echo $daten["time"]; ?></td>
                        <td><?php echo $daten["value"]; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
    <?php } ?>
</div>