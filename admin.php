 
<?php
$app->on('admin.init', function() {
    $this->on('app.layout.header', function() {
        $filename = __DIR__ . '/assets/components.json';
        if (file_exists($filename)) {
            $content = @file_get_contents($filename);
            if (!$content) {
                return;
            }
        ?>
        <script>
            window.CP_LAYOUT_COMPONENTS = App.$.extend(window.CP_LAYOUT_COMPONENTS || {}, <?=$content?>);
        </script>
        <?php
            //echo $this->script('#config:components.js', time());
        }
    });
});