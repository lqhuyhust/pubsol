<?php 
    if(strcmp($this->item['version_id'], '0') == 0) {
        $status = false;
    } elseif ($this->version_lastest > $this->item['version_id']) {
        $status = true;
    } else {
        $status = false;
    }
?>
<tr>
    <td>
        <input class="checkbox-item"  type="checkbox" name="ids[]" value="<?php echo $this->item['id']; ?>">
    </td>
    <td><a href="<?php echo $this->link_detail . '/' . $this->item['id']; ?>"><?php echo  $this->item['title']  ?></a></td>
    <td><?php echo $this->item['tag_tmp'];?></td>
    <td>
        <?php $description = $this->item['description'] ? $this->item['description'] : ''; ?>
        <span class="d-block description-request"><?php echo  $description;  ?></span>
    </td>
    <td><?php echo   $this->item['creator'] ?></td>
    <td><?php echo  $this->item['start_at'] != '0000-00-00 00:00:00' && $this->item['start_at'] ? date('Y-m-d', strtotime($this->item['start_at'])) : '' ?></td>
    <td><?php echo  $this->item['finished_at'] != '0000-00-00 00:00:00' && $this->item['finished_at'] ? date('Y-m-d', strtotime($this->item['finished_at'])) : '' ?></td>
    <td>
        <a class="fs-4 me-1 show_data" 
            href="#"
            data-id="<?php echo  $this->item['id'] ?>" 
            data-title="<?php echo  $this->item['title']  ?>" 
            data-description="<?php echo ($this->item['description']); ?>" 
            data-finished_at="<?php echo date('Y-m-d', strtotime($this->item['finished_at'])); ?>" 
            data-start_at="<?php echo date('Y-m-d', strtotime($this->item['start_at'])); ?>" 
            data-bs-placement="top" 
            data-tags='<?php echo json_encode($this->item['tags']);?>' 
            data-bs-toggle="modal" 
            data-bs-target="#exampleModalToggle">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
    </td>
    <td></td>
</tr>