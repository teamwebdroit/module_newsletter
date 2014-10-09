<div class="wp-pagenavi">
    <span class="pages">Page <?php echo $paginator->getCurrentPage(); ?> de <?php echo $paginator->getTotal(); ?></span>
    <?php echo with(new \Droit\Presenter\WpNavi($paginator))->render(); ?>
</div>