<tr>
    <td>
        <input class="checkbox-item" type="checkbox" name="ids[]" value="<?php echo $this->item['id']; ?>">
    </td>
    <td>
        <a href="#" class="show_data" 
            data-id="<?php echo  $this->item['id'] ?>" 
            data-title="<?php echo  $this->item['title']  ?>" 
            data-status="<?php echo   $this->item['status'] ?>" 
            data-start_date="<?php echo   $this->item['start_date'] ? date('Y-m-d', strtotime($this->item['start_date'])) : '';  ?>" 
            data-description="<?php echo ($this->item['description']); ?>" 
            data-end_date="<?php echo   $this->item['end_date'] ? date('Y-m-d', strtotime($this->item['end_date'])) : '';  ?>" 
            data-bs-placement="top" 
            data-bs-toggle="modal" 
            data-bs-target="#exampleModalToggle"><?php echo  $this->item['title']  ?>
        </a>
    </td>
    <td>
        <?php $description = $this->item['description'] ? $this->item['description'] : ''; ?>
        <?php echo  strlen(strip_tags($description)) > 50 ? substr(strip_tags($description), 0, 50) .'...' : $description;  ?>
    </td>
    <td><?php echo   $this->item['status'] ? 'Show' : 'Hide';  ?></td>
    <td><?php echo   $this->item['start_date'] ? date('m-d-Y', strtotime($this->item['start_date'])) : '';  ?></td>
    <td><?php echo   $this->item['end_date'] ? date('m-d-Y', strtotime($this->item['end_date'])) : '';  ?></td>
    <td><?php echo   $this->item['created_at'] ? date('m-d-Y', strtotime($this->item['created_at'])) : '';  ?></td>
    <td>
        <a href="#" 
            class="fs-4 me-1 show_data" 
            data-id="<?php echo  $this->item['id'] ?>" 
            data-title="<?php echo  $this->item['title']  ?>" 
            data-status="<?php echo   $this->item['status']?>"
            data-start_date="<?php echo   $this->item['start_date'] ? date('Y-m-d', strtotime($this->item['start_date'])) : '';  ?>" 
            data-description="<?php echo ($this->item['description']); ?>" data-end_date="<?php echo   $this->item['end_date'] ? date('Y-m-d', strtotime($this->item['end_date'])) : '';  ?>" 
            data-bs-placement="top" 
            data-bs-toggle="modal" 
            data-bs-target="#exampleModalToggle">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
    </td>
</tr>