<div class="content-small">
    <h1>Dateneingabe</h1>
    <form method="post">
        <div class="mb-3">
            <label for="meter" class="form-label">Zähler</label>
            <select class="form-select" id="meter" name="meter_id">
                <?php foreach ($data["zaehler"] as $key => $value) {
                    echo "<option value=\"" . $value["id"] . "\">" . $value["name"] . "</option>";
                }?>
            </select>
        </div>
        <div class="mb-3">
            <label for="value" class="form-label">Wert</label>
            <input class="form-control" name="value" type="number" step="0.1">
        </div>
        <div class="mb-3">
            <label for="time" class="form-label">Zeitpunkt</label>
            <input class="form-control" name="time" type="datetime-local" value="<?= $data["datetime"]?>">
        </div>
        <input type="submit" class="btn btn-primary">

    </form>

</div>
