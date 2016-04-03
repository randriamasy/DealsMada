<h1>Cities</h1>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Delete</th>
        </tr>
    </thead> 
    <tbody>
        <?php foreach ($cities as $item): ?>
            <tr>
                <td style="text-align: left"><?= $item->name ?></td>
                <td style="width: 80px"><a href="<?= BASE_URL ?>/city/delete/<?= $item->id ?>"><img src="<?= DELETE_ICON_URL ?>"></a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
