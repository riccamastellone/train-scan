<table class="table table-striped">
    <thead>
        <tr>
            <th>Numero Treno</th>
            <th>Partenza</th>
            <th>Arrivo</th>
            <th>Classe</th>
            <th>Prezzo</th>
            <th style="width:90px"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($quotazioni as $quotazione) { ?>
            <tr>
                <td><?php echo $quotazione["codice_treno"]; ?></td>
                <td><?php echo substr($quotazione["partenza"], 0, -3); ?></td>
                <td><?php echo substr($quotazione["arrivo"], 0, -3); ?></td>
                <td><?php echo $quotazione["nome_classe"]; ?></td>
                <td><?php echo $quotazione["prezzo"]; ?> €</td>
                <td><button type="button" onclick="javascript:alert('minga bello')" class="btn btn-success">Acquista</button></td>
            </tr>
       <?php } ?>
    </tbody>
</table>