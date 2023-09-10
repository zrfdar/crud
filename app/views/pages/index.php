<?php
$title = 'Pages';
ob_start();
?>

<div class="row justify-content-center mt-5">

        <h1 class="mb-4">Pages list</h1>
        <a href="index.php?page=pages&action=create" class="btn btn-success">Create page</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pages as $page): ?>
                    <tr>
                        <td><?php echo $page['id'] ?></td>
                        <td><?php echo $page['title'] ?></td>
                        <td><?php echo $page['slug'] ?></td>
                        <td>
                            <a href="index.php?page=pages&action=edit&id=<?php echo $page['id'] ?>"
                                class="btn btn-sm btm-outline-primary">Edit</a>
                            <form method="POST" action="index.php?page=pages&action=delete&id=<?php echo $page['id'] ?>"
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

<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>