<h1>Cities | <a href="<?= BASE_URL . '/city' ?>"> Add </a></h1>

<table>
    <thead>
        <tr>
            <th style="text-align: left">Name</th>
            <th style="width: 80px">Delete</th>
        </tr>
    </thead> 
    <tbody>
        <?php foreach ($cities as $item): ?>
            <tr>
                <td style="text-align: left"><?= $item->name ?></td>
                <td style="width: 80px"><a href="javascript:confirmUrl('<?= BASE_URL ?>/city/delete/<?= $item->id ?>')"><image src="<?= DELETE_ICON_URL ?>"></a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
