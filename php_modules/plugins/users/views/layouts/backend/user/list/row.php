<?php
    use SPT\App;
?>
<tr class="odd">
    <th scope="row" class="align-middle p-2"
        style="text-align: center;width: 3rem;">
        <input type="checkbox" name="ids[]" value="<?php echo $this->item['id'] ?>">
    </th>
    <td class="dtr-control sorting_1 pl-12 td_name align-middle"
        tabindex="0">
        <a href="<?php echo $this->link_user_form.$this->item['id']; ?>"
            class="text-decoration-none">
            <img loading="lazy" width="40" height="40"
                style="object-fit: cover;" class="mr-2"
                src="<?php echo $this->url. '/media//'. $this->item['avatar']; ?>"
                alt="">
                <?php echo $this->item['name']; ?> </a>
    </td>
    <td class="align-middle"><?php echo $this->item['username']; ?></td>
    <td class="align-middle">
        <?php
            if ($this->item['groups']){
                foreach($this->item['groups'] as $item) 
                {
                    if ($item['group_name'])
                    {
                        echo '<span class="cate name_style">'.$item['group_name'].'</span>';
                    }
                }
            } else {
                echo 'no group';
            }
        ?>
    <td class="align-middle"> <?php echo $this->item['email']; ?> </td>
    <td style="width: 150px;" class="align-middle">
        <span class="cate" style="background: <?php echo $this->item['status'] == 1 ? 'green' : 'gray'; ?>;"><?php echo $this->item['status'] == 1 ? 'Active' : 'UnActive'; ?></span>
    </td>
    <td style="width: 40px;" class="align-middle">

        <?php 
            if($this->user_id != $this->item['id']) 
            {
        ?>
            <button
            type="button"
            data-id="<?php echo $this->item['id']; ?>"
            class="btn btn-block btn-outline-secondary btn-sm btn-delete-row"
            style="width: 33px;margin: 0 auto;"><i
                class="fas fa-trash-alt"></i></button> 
        <?php
            }
        ?>
    </td>
</tr>
