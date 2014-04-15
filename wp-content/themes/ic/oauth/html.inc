
  <?php if (isset($menu)) { ?>
    <?php echo $menu; ?>
  <?php } ?>

<?php if (isset($status_text)) { ?>
  <?php echo '<h3>'.$status_text.'</h3>'; ?>
<?php } ?>

    <?php print_r($content); ?>

