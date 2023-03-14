<tr>
    <td>
        <input class="checkbox-item" type="checkbox" name="ids[]" value="<?php echo $this->item['id']; ?>">
    </td>
    <td>
        <?php if($this->item['parent_note'] != 0) { ?> <i class="fa-solid fa-ellipsis-vertical"></i> <i class="fa-solid fa-minus"></i> <?php } ?>
        <a href="<?php echo $this->link_form . '/' . $this->item['id']; ?>"><?php echo  $this->item['title']  ?></a>
        <p class="p-0 m-0 text-muted"><?php echo $this->item['note']?></p>
    </td>
    <td><?php echo !empty($this->data_tags[$this->item['id']]) ? $this->data_tags[$this->item['id']] : '' ?></td>
</tr>
