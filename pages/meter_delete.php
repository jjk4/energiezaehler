<div class="content-small">
    <h1>Zähler löschen</h1>
    Bist du dir sicher, dass du den Zähler <strong><?= $data["zaehler"]["name"]?></strong> löschen möchtest?
    <form method="post">
        <input type="hidden" name="id" value="<?= $data["zaehler"]["id"]?>">
        <button type="submit" class="btn btn-danger">Ja, diesen Zähler löschen</button>
    </form><br>
    <a href="?a=settings" class="btn btn-primary">Nein, diesen Zähler behalten</a>
</div>