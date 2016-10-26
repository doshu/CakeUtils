<ul class="pagination">
    <?= $this->Paginator->prev('<i class="fa fa-angle-left"></i>', ['escape' => false]) ?>
    <?= $this->Paginator->numbers() ?>
    <?= $this->Paginator->next('<i class="fa fa-angle-right"></i>', ['escape' => false]) ?>
</ul>
<p><?= $this->Paginator->counter('{{page}} di {{pages}}') ?></p>
<?php //in javascript forzo il link della prima pagina ad avere page=1 */ ?>
<script>
    $('.paginator .pagination a').each(function() {
        if($(this).attr('href')) {
            if($(this).attr('href').indexOf('?') >= 0) {
                var queryString = $(this).attr('href').substr($(this).attr('href').indexOf('?') + 1);
                if(queryString.indexOf('page=') == -1) {
                    $(this).attr('href', $(this).attr('href')+'&page=1');
                }
            }
            else {
                $(this).attr('href', $(this).attr('href')+'?page=1');
            }
        }
    });
</script>
