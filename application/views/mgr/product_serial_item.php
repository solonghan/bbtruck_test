<tr id="tr_<?=$item['id'] ?>">
    <td><?=$item['id'] ?></td>
    <td><?=$item['code'] ?></td>
    <td><?=$download ?></td>
    <td><?=$item['create_date'] ?></td>
    <td>
        <button onclick="location.href='<?=base_url()."mgr/product/serial/".$m_id."/edit/".$item['id'] ?>'" class="btn btn-primary btn-xs"><span class="fa fa-fw ti-pencil"></span></button>
        
        <button id="del_<?=$item['id'] ?>" class="btn btn-danger btn-xs del-btn"><span class="fa fa-fw fa-minus-square-o"></span></button>
    </td>
</tr>