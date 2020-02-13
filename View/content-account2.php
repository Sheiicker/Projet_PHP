<h1>Administration</h1>
<table>
  <tbody>
    <tr>
      <th class='adminusers'>User</th>
      <th class='adminusers'>Money</th>
    </tr>
    <?php
      $resource = $link->query('SELECT * FROM user WHERE 1');
      while ( $rows = $resource->fetch_assoc() ) :?>
      <tr>
        <td class='adminusers'><?=$rows['pseudo'];?></td>
        <td class='adminusers'><?=$rows['money'];?></td>
        <td class='adminaddmoney' onclick='addmoney(event)'>Ajout $5</td>
        <td class='adminaddmoney' onclick='takemoney(event)'>Retrait $5</td>
      </tr>
    <?php endwhile;?>
  </tbody>
</table>
