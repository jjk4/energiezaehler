<div class="content-mid">
    <h1>Einstellungen</h1>
    <h2>Zähler</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Einheit</th>
                <th>Aktueller Stand</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data["zaehler"] as $key => $value) {?>
            <tr>
                <td><?= $value["name"]?></td>
                <td><?= $value["unit"]?></td>
                <td><?= $value["max"]?></td>
                <td>
                    <a href="?a=settings&s=edit&id=<?= $value["id"]?>"><i class="bi bi-pencil-square"></i></a>
                    <a href="?a=settings&s=delete&id=<?= $value["id"]?>"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>
    <a class="btn btn-primary" href="?a=settings&s=add">Zähler hinzufügen</a>
</div>
