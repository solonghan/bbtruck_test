<tr data-id="<?= $item['id'] ?>">
    <td><?= $item['id'] ?></td>
    <td><?= $item['order_no'] ?>
    <td><?= $item['creator'] ?>
    <td><?= $item['passanger_name'] ?>
    <td><?= $item['send_postcode'] ?>
    <td><?= $item['send_city'] ?>
    <td><?= $item['send_address'] ?>
    
    <td><?= $item['recipient_postcode'] ?>
    <td><?= $item['recipient_city'] ?>
    <td><?= $item['recipient_address'] ?>
   
    

 
    <td>
        <!--<button class="btn btn-success btn-xs" onclick="location.href='<?= base_url() ?>mgr/huntground/post_list/<?= $item['id'] ?>';" data-toggle="tooltip" data-original-title="文章列表"><i class="fa fa-fw ti-menu-alt"></i></button>-->
        <button class="btn btn-primary btn-xs" onclick="location.href='<?= base_url() ?>mgr/bill/edit/<?= $item['id'] ?>';" data-toggle="tooltip" data-original-title="編輯"><i class="fa fa-fw ti-pencil"></i></button>
        <button class="btn btn-danger btn-xs del-btn" onclick = "location.href='<?= base_url()?>mgr/bill/local_del/<?=$item['id'] ?>';"data-toggle="tooltip" data-original-title="刪除"><i class="fa fa-fw ti-trash"></i></button>
    </td>
</tr>