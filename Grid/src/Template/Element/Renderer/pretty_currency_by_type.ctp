<?php if($renderer->row->type) : ?>
    <span class="green-text text-accent-4">
        <i class="material-icons">trending_up</i>
        + <?= \Cake\I18n\Number::currency($renderer->value, 'EUR') ?>
    </span>
<?php else: ?>
    <span class="red-text text-accent-4">
        <i class="material-icons">trending_down</i>
        - <?= \Cake\I18n\Number::currency($renderer->value, 'EUR') ?>
    </span>
<?php endif; ?>
