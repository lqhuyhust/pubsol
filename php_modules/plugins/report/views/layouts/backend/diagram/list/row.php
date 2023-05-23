<tr>
    <td>
        <input class="checkbox-item" type="checkbox" name="ids[]" value="<?php echo $this->item['id']; ?>">
    </td>
    <td>
        <a href="<?php echo is_array($this->item['report_type']) ? $this->item['report_type']['detail_link']. '/' . $this->item['id'] : '' ; ?>">
            <?php echo  $this->item['title']  ?>
        </a>
    </td>
    <td><?php echo   is_array($this->item['report_type']) ? $this->item['report_type']['title'] : $this->item['report_type'];  ?></td>
    <td><?php echo   $this->item['status'] ? 'Show' : 'Hide';  ?></td>
    <td><?php echo   $this->item['auth'];  ?></td>
    <td><?php echo   $this->item['created_at'];  ?></td>
</tr>