<tr>
    <td>
        <input class="checkbox-item-relate-note" type="checkbox" name="ids[]" value="<?php echo $this->item['id']; ?>">
    </td>
    <td>
        <a target="_blank" href="<?php echo $this->link_note. '/'. $this->item['note_id']; ?>"><?php echo  $this->item['title']  ?></a>
    </td>
    <td><?php echo !in_array($this->item['editor'], ['presenter', 'sheetjs']) ? $this->item['description'] : '' ?></td>
    <td><?php echo   $this->item['tags'] ?></td>
</tr>