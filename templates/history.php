<div id="middle">
<h1><?php echo($spot)?></h1>

<table class= "table table_striped">
<thead>
    <tr>
        <th>Rating</th>
        <th>Height</th>
        <th>Conditions</th>
        <th>Swell 1</th>
        <th>Swell 2</th>
        <th>Swell 3</th>
        <th>Tide</th>
        <th>Wind</th>
        <th>Description</th>
        <th>Date</th>
    </tr>
</thead>
<tbody>
<?php foreach ($rows as $row): ?>

    <tr>
        <td class="alnleft"><?= $row["rating"] ?></td>
        <td class="alnleft"><?= $row["height"] ?></td>
        <td class="alnleft"><?= $row["conditions"] ?></td>
        <td class="alnleft"><?= $row["swell_p"] ?></td>
        <td class="alnleft"><?= $row["swell_s"] ?></td>
        <td class="alnleft"><?= $row["swell_t"] ?></td>
        <td class="alnleft"><?= $row["tide"] ?></td>
        <td class="alnleft"><?= $row["wind_spd"]?>kts <?= $row["wind_dir"] ?></td>
        <td class="alnleft"><?= $row["description"] ?></td>
        <td class="alnleft"><?= $row["time"] ?></td>
    </tr>
<?php endforeach ?>
</tbody>
</table>
<a href='lookup.php'>Back</a>

