<h2><a href='/index.php/requests/edit'>Create request</a></h2>
<div>
    <table class="table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr>
                <th>ID</th>
                <th>Додано</th>
                <th>Тема запиту</th>
                <th>Текст запиту</th>
                <th>Автор запиту</th>
                <th>Депутат</th>
                <th>Відповідь</th>
                <th>Статус</th>
                <th>Дія</th>
            </tr>
        </thead>
    <?php foreach ($requests as $request): ?>
        <tr>
            <td><?= $request['requestid'] ?></td>
            <td><?= $request['adddate'] ?></td>
            <td><a href="<?php echo site_url('/requests/'.$request['requestid']); ?>"><?= $request['title'] ?></a></td>
            <td><?= $request['text'] ?></td>
            <td><a href="<?php echo site_url('/requests/filter/user/'.$request['user_id']); ?>"><?= fullname($request) ?></a></td>
                <!-- Заменить deputy_id на deputy_name после реализации таблицы deputys! -->
            <td><a href="<?php echo site_url('/requests/filter/deputy/'.$request['deputy_id']); ?>"><?= $request['deputy_id'] ?></td>
            <td>
                <?php if (!($request['reply_id'] == 0)): ?>
                    <?php echo site_url('/requests/'.$request['reply_id']); ?>
                <?php endif; ?>
            </td>
            <td><?= $request['status'] ?></td>
            <td>
                <a href="<?= site_url('/requests/edit/'.$request['requestid']) ?>">
                    <span class="glyphicon glyphicon-pencil" title="Edit user <?= $request['requestid'] ?>"></span>
                </a>
                <a href="<?= site_url('/requests/delete/'.$request['requestid']) ?>" onClick='return confirm("Are you sure to delete this request?");'>
                    <span class="glyphicon glyphicon-remove" title="Delete request <?= $request['requestid'] ?>"></span>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>