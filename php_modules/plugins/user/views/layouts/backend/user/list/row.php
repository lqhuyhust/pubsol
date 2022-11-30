<tr>
    <td><?php echo $this->index ?></td>
    <td><a href="<?php echo $this->link_form . '/' . $this->item['id']; ?>"><?php echo  $this->item['username']  ?></a></td>
    <td><?php echo  $this->item['name'];  ?></td>
    <td><?php echo   $this->item['email'];  ?></td>
    <td><?php echo   $this->item['status'] ? 'Active' : 'Inactive';  ?></td>
    <td><?php echo   $this->item['created_at'] ? date('m-d-Y', strtotime($this->item['created_at'])) : '';  ?></td>
    <td>
        <form  id="form_delete_<?php echo $this->item['id']; ?>" action="<?php echo $this->link_form. "/" .$this->item['id']; ?>" method="POST">
            <input type="hidden" value="<?php echo $this->token ?>" name="token">
            <input type="hidden" value="DELETE" name="_method">
            <a class="fs-6" href="<?php echo $this->link_form . '/' . $this->item['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
            <?php if ($this->user_id != $this->item['id']) { ?>
            <a class="button_delete_item fs-6" href="#" data-id_remove="<?php echo $this->item['id']; ?>"><i class="fa-solid fa-trash"></i></a>
            <?php } ?>
        </form>
    </td>
</tr>