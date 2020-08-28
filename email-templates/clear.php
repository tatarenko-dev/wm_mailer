<?php global $email_fields; ?>

<h2>Поля формы</h2>
<?php foreach($email_fields as $key => $field) : ?>
    <?php if ($field) : ?>
        <p><b><?php echo $key; ?></b> <?php echo $field; ?></p>
    <?php endif; ?>
<?php endforeach; ?>