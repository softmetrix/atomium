<br />

<div class="window">
  <div class="terminal">
    <p class="command">Install</p>
    <p class="log">
      <span>
        <?= nl2br($output); ?>
      </span>
    </p>
  </div>
</div>
<?php
if ($retVal === 0) {
    echo 'Installation successful.<br />';
    echo '<a href="/">Go to application</a>';
} else {
    echo 'Installation failed.';
}
?>