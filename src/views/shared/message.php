<div class="message"
     style="color:#304341;font-size: 1.5rem;">
    <?
    if (isset($messages)) {
        foreach ($messages as $message) {
            echo $message;
        }
    }
    ?>
</div>