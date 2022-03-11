<tr data-id="<?= $item['id'] ?>">
    <td><?= $item['id'] ?></td>
    <td><?= $item['order_no'] ?>
    <td><?= $item['order_state'] ?>
    <td><?= $item['username'] ?>
    <td><?= $item['company'] ?>
    <td><?= $item['email'] ?>
    <td><?= $item['phone'] ?>
    <td><?= $item['country'] ?>
    
    <td><?= $item['street'] ?>
    <td><?= $item['city'] ?>
    <td><?= $item['state'] ?>
    <td><?= $item['price'] ?>
   
    

 
    <td>
        <!--<button class="btn btn-success btn-xs" onclick="location.href='<?= base_url() ?>mgr/huntground/post_list/<?= $item['id'] ?>';" data-toggle="tooltip" data-original-title="文章列表"><i class="fa fa-fw ti-menu-alt"></i></button>-->
        <button class="btn btn-primary btn-xs" onclick="location.href='<?= base_url() ?>mgr/order_data/edit/<?= $item['id'] ?>';" data-toggle="tooltip" data-original-title="編輯"><i class="fa fa-fw ti-pencil"></i></button>
        <button class="btn btn-danger btn-xs del-btn" onclick = "location.href='<?= base_url()?>mgr/order_data/local_del/<?=$item['id'] ?>';"data-toggle="tooltip" data-original-title="刪除"><i class="fa fa-fw ti-trash"></i></button>
    </td>
</tr>