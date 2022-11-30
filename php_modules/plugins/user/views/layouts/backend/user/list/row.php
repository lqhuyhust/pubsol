<tr>
    <td>
        <?php if ($this->user_id != $this->item['id']) : ?>
        <input class="checkbox-item" type="checkbox" name="ids[]" value="<?php echo $this->item['id']; ?>">
        <?php endif; ?>
    </td>
    <td><a href="<?php echo $this->link_form . '/' . $this->item['id']; ?>"><?php echo  $this->item['username']  ?></a></td>
    <td><?php echo  $this->item['name'];  ?></td>
    <td><?php echo   $this->item['email'];  ?></td>
    <td><?php echo   $this->item['status'] ? 'Active' : 'Inactive';  ?></td>
    <td><?php echo   $this->item['created_at'] ? date('m-d-Y', strtotime($this->item['created_at'])) : '';  ?></td>
    <td>
        <a class="fs-4 me-1" href="<?php echo $this->link_form . '/' . $this->item['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
        <?php if ($this->user_id != $this->item['id']) { ?>
        <a data-id="<?php echo  $this->item['id'] ?>" style="color:#3b7ddd;" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="delete fs-4 ps-1 border-0 bg-transparent button_delete_item"><i class="fa-solid fa-trash"></i></a>
        <?php } ?>
    </td>
</tr>