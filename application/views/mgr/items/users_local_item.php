<tr data-id="<?= $item['id'] ?>">
    <td><?= $item['id'] ?></td>
    <td><?= $item['username'] ?>
    <td><?= $item['phone'] ?>
    <td><?= $item['addr'] ?>
    <td><?= $item['birthday'] ?>
    <td><?= $item['password'] ?>
    <td><?= $item['email'] ?>
   
    

 
    <td>
        <!--<button class="btn btn-success btn-xs" onclick="location.href='<?= base_url() ?>mgr/huntground/post_list/<?= $item['id'] ?>';" data-toggle="tooltip" data-original-title="文章列表"><i class="fa fa-fw ti-menu-alt"></i></button>-->
        <button class="btn btn-primary btn-xs" onclick="location.href='<?= base_url() ?>mgr/users/edit/<?= $item['id'] ?>';" data-toggle="tooltip" data-original-title="編輯"><i class="fa fa-fw ti-pencil"></i></button>
        <button class="btn btn-danger btn-xs del-btn" onclick = "location.href='<?= base_url()?>mgr/users/local_del/<?=$item['id'] ?>';"data-toggle="tooltip" data-original-title="刪除"><i class="fa fa-fw ti-trash"></i></button>
    </td>
</tr>