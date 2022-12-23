<tr>
    <td>
        <input class="checkbox-item-relate-note" type="checkbox" name="ids[]" value="<?php echo $this->item['id']; ?>">
    </td>
    <td>
        <a href="<?php echo $this->link_note. '/'. $this->item['note_id']; ?>"><?php echo  $this->item['title']  ?></a>
    </td>
    <td>
        <?php $description = $this->item['description'] ? $this->item['description'] : ''; ?>
        <?php echo  strlen(strip_tags($description)) > 50 ? substr(strip_tags($description), 0, 50) .'...' : $description;  ?>
    </td>
    <td><?php echo   $this->item['tags'] ?></td>
</tr>