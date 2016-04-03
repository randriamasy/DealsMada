
<h1>
    <a href="<?= $_SERVER['HTTP_REFERER'] ?>">Cities</a> | Add
</h1>

<form enctype="multipart/form-data" method="POST"
      action="<?= BASE_URL ?>/city/add">
    <table>
        <tr>
            <th>
                Name
            </th>
            <td style="text-align: left">
                <input type="text" name="name" size="80">
            </td>
        </tr>
        <tr>
            <th>

            </th>
            <td style="text-align: left">
                <input class="btn btn-default" type="submit" name="submit-btn"
                       value="Add">
            </td>
        </tr>
    </table>
</form>
