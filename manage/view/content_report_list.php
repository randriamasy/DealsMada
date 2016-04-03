<h1>Events</h1>

<table>
    <thead>
        <tr>
            <th>Event</th>
            <th>Count</th>
            <th>View</th>
            <th>Delete</th>
        </tr>
    </thead> 
    <tbody>
        <?php foreach ($events as $item): ?>
            <tr>
                <td style="text-align: left"><?= $item->event ?></td>
                <td style="width: 80px"><?= $item->count ?></td>
                <td style="width: 80px">
                    <form action="<?= BASE_URL ?>/report/view/" method="GET">
                        <input type="hidden" name="event" value="<?= $item->event ?>" />
                        <input type="submit" value="View" />
                    </form>
                </td>
                <td style="width: 80px">
                    <form action="<?= BASE_URL ?>/report/delete/" method="POST">
                        <input type="hidden" name="event" value="<?= $item->event ?>" />
                        <input type="submit" value="Delete" />
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</p>


<h1>Errors</h1>

<table>
    <thead>
        <tr>
            <th>Event</th>
            <th>Count</th>
            <th>View</th>
            <th>Delete</th>
        </tr>
    </thead> 
    <tbody>
        <?php foreach ($errors as $item): ?>
            <tr>
                <td style="text-align: left"><?= $item->event ?></td>
                <td style="width: 80px"><?= $item->count ?></td>
                <td style="width: 80px">
                    <form action="<?= BASE_URL ?>/report/view/" method="GET">
                        <input type="hidden" name="event" value="<?= $item->event ?>" />
                        <input type="submit" value="View" />
                    </form>
                </td>
                <td style="width: 80px">
                    <form action="<?= BASE_URL ?>/report/delete/" method="POST">
                        <input type="hidden" name="event" value="<?= $item->event ?>" />
                        <input type="submit" value="Delete" />
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</p>