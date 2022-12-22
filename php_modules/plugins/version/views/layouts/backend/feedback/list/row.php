<tr>
    <td>
        <a href="<?php echo $this->link_form . '/' . $this->item['id']; ?>" target="_blank">
            <?php echo  $this->item['title']  ?><i class="fa-solid fa-arrow-up-right-from-square ms-2"></i>
        </a>
    </td>
    <td>
        <?php $description = $this->item['description'] ? $this->item['description'] : ''; ?>
        <?php echo  strlen(strip_tags($description)) > 50 ? substr(strip_tags($description), 0, 50) . '...' : $description;  ?>
    </td>
    <td><?= !empty($this->data_tags[$this->item['id']]) ? $this->data_tags[$this->item['id']] : '' ?></td>
</tr>