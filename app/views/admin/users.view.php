<div class="table-responsive">
  <table class="table table-stripped table-hover">
    <thead>
      <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Role</th>
        <th>Date</th>
        <th>
          <a href="index.php?page_name=signup">
            <button class="btn btn-success btn-sm"><i class="bi bi-plus-lg"></i> Add new</button>
          </a>
        </th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($users)) : ?>
      <?php foreach ($users as $user) : ?>
      <tr>
        <td>
          <a href="index.php?page_name=profile&id=<?= $user['id'] ?>">
            <img src="<?= cropImg($user['image'], 100, $user['gender']) ?>" alt="" width="100">
          </a>
        </td>
        <td><?= esc($user['name']) ?></td>
        <td>
          <a href="index.php?page_name=profile&id=<?= $user['id'] ?>">
            <?= esc($user['username']) ?>
          </a>
        </td>
        <td><?= esc($user['email']) ?></td>
        <td><?= ucfirst(esc($user['gender'])) ?></td>
        <td><?= esc($user['role']) ?></td>
        <td><?= date("jS M, Y", strtotime($user['date'])) ?></td>
        <td>
          <div class="btn-group">
            <a href="index.php?page_name=edit_user&id=<?= $user['id'] ?>">
              <button class="btn btn-success btn-sm">Edit</button>
            </a>
            <?php if ($user['role'] != 'admin') : ?>
            <!-- <a href="index.php?page_name=delete_user&id=<?= $user['id'] ?>">
              <button class="btn btn-danger btn-sm">Delete</button>
            </a> -->
            <?php endif; ?>
            <a href="index.php?page_name=delete_user&id=<?= $user['id'] ?>">
              <button class="btn btn-danger btn-sm">Delete</button>
            </a>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>

      <?php endif; ?>
    </tbody>
  </table>

  <?php $pagination->display(count($users)); ?>

</div>