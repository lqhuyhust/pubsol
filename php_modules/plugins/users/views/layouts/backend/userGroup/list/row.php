<tr class="odd">
    <th scope="row" class="align-middle"
        style="text-align: center;width: 3rem;">
        <input type="checkbox" name="ids[]" id="group_id_<?php echo $this->item['id']; ?>" value="<?php echo $this->item['id']; ?>">
    </th>
    <td class="dtr-control sorting_1 p-2 pl-12 td_name align-middle"
        tabindex="0">
        <a href="<?php echo $this->link_user_group_form.$this->item['id']; ?>"
            class="text-decoration-none">
            <?php echo $this->item['name']; ?> </a>
    </td>
    <td class="align-middle">
        <div>
            <?php 
                foreach($this->item['access'] as $access) 
                {
                    echo '<span class="cate">'.$access.'</span>';
                }
            ?>
        </div>
    </td>
    <td style="width: 50px;text-align: center;"
        class="align-middle"> <?php echo $this->item['user_in']; ?> </td>
    <td style="width: 150px;" class="align-middle">
        <span class="cate" style="background: <?php echo $this->item['status'] !=0 ? 'green' : 'gray'; ?>;"><?php echo $this->item['status'] !=0 ? 'Active' : 'UnActive'; ?></span>
    </td>
    <td style="width: 40px;" class="align-middle"> 
        <button
            type="button"
            data-item-id="<?php echo $this->item['id'];?>"
            class="btn btn-block btn-outline-secondary btn-sm btn-item-user-group"
            style="width: 33px;margin: 0 auto;"><i
            class="fas fa-trash-alt"></i></button> 
    </td>
</tr>