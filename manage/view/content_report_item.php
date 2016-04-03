
<h1>
    <a href='<?= BASE_URL ?>/report'>Reports</a> | <?= $reports[0]->event ?>
</h1>


<?php foreach ($reports as $report) { ?>

    <table>

        <tr>
            <th style="width: 100px">
                SentAt
            </th>
            <td style="text-align: left;">
                <?= $report->sentAt ?>
            </td>
        </tr>

        <tr>
            <th>
                Device
            </th>
            <td style="text-align: left;">
                <?= $report->device ?>
            </td>
        </tr>

        <tr>
            <th>
                Version
            </th>
            <td style="text-align: left;">
                <?= $report->os ?>
            </td>
        </tr>

        <tr>
            <th>
                Build
            </th>
            <td style="text-align: left;">
                <?= $report->build ?>
            </td>
        </tr>

        <tr>
            <th>
                Description
            </th>
            <td style="text-align: left; white-space:pre-wrap ; ">
                <?= "\n" . $report->description ?>
            </td>
        </tr>

    </table>

    <br/> <br/>
    <?php
}?>