<?php
$title = 'Roles';
ob_start();
?>

<div class="row justify-content-center mt-5">
    <div class="col-lg-6 col-md-8 col-sm-10">
        <h1 class="text-center mb-4">Roles list</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Role Name</th>
                    <th>Role Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roles as $role): ?>
                    <tr>
                        <td>
                            <?php echo $role['id'] ?>
                        </td>
                        <td>
                            <?php echo $role['role_name'] ?>
                        </td>
                        <td>
                            <?php echo $role['role_description'] ?>
                        </td>
                        <td>
                            <a href="index.php?page=roles&action=edit&id=<?php echo $role['id'] ?>"
                                class="btn btn-sm btm-outline-primary">Edit</a>
                            <form method="POST" action="index.php?page=roles&action=delete&id=<?php echo $role['id'] ?>"
                                class="d-inline-block">
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>