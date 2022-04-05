<div class="content-small">
    <h1>Zähler bearbeiten</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?= $data["zaehler"]["id"]?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $data["zaehler"]["name"]?>">
        </div>
        <div class="form-group">
            <label for="unit">Einheit</label>
            <input type="text" class="form-control" id="unit" name="unit" value="<?= $data["zaehler"]["unit"]?>">
        </div>
        <button type="submit" class="btn btn-primary">Zähler bearbeiten</button>
</div>
