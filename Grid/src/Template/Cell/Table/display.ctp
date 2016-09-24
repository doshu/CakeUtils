<?php if($table->paginate()): ?>
    <?= $this->Form->create(null, ['type' => 'get']); ?>                
<?php endif; ?>
<table class="striped responsive-table">
    <thead>
        <tr>
            <?php foreach($table->getColumns() as $column => $options): ?>
                <th>
                    <?php if($table->paginate() && $table->getColumnSortable($column)): ?>
                        <?= $this->Paginator->sort($table->getColumnSortIndex($column), $table->getColumnHeader($column)); ?></th>
                    <?php else: ?>
                        <?= $table->getColumnHeader($column); ?>
                    <?php endif; ?>
                </th>
            <?php endforeach; ?>
            <?php if($table->hasActions()): ?>
                <th></th>
            <?php endif; ?>
        </tr>
        <?php if($table->paginate()): ?>
            
            <tr style="background-color:#f6f6ff;">
                <?php foreach($table->getColumns() as $column => $options): ?>
                    <th style="vertical-align:top; border-radius:0;">
                        <?php if($table->getColumnFilterable($column)): ?>
                            <?php
                                $filterType = $table->getColumnFilterType($column);
                                $columnType = $table->getColumnType($column);
                            ?>
                            <?php if($filterType == 'range'): ?>
                                <div>
                                    <?= 
                                        $this->Form->input('filter.'.$column.'.from', [
                                            'class' => $columnType == 'date'?'datepicker':'', 
                                            'type' => 'text', 
                                            'label' => 'Da',
                                            'value' => isset($this->request->query['filter'][$column]['from'])?
                                                $this->request->query['filter'][$column]['from']:''
                                        ]);
                                    ?>
                                </div>
                                <div>
                                    <?= 
                                        $this->Form->input('filter.'.$column.'.to', [
                                            'class' => $columnType == 'date'?'datepicker':'', 
                                            'type' => 'text', 
                                            'label' => 'A',
                                            'value' => isset($this->request->query['filter'][$column]['to'])?
                                                $this->request->query['filter'][$column]['to']:''
                                        ]);
                                    ?>
                                </div>
                            <?php elseif($filterType == 'select'): ?>  
                                <?= 
                                    $this->Form->input('filter.'.$column, [
                                        'type' => 'select', 
                                        'options' => $table->getColumnOptions($column),
                                        'label' => false,
                                        'empty' => true,
                                        'class' => '',
                                        'value' => isset($this->request->query['filter'][$column])?
                                                $this->request->query['filter'][$column]:''
                                    ]);
                                ?>
                            <?php else: ?>
                                <?= 
                                    $this->Form->input('filter.'.$column, [
                                        'type' => 'text', 
                                        'label' => false,
                                        'value' => isset($this->request->query['filter'][$column])?
                                                $this->request->query['filter'][$column]:''
                                    ]);
                                ?>
                            <?php endif; ?>                          
                            
                        <?php endif; ?>
                    </th>
                <?php endforeach; ?>
                <?php if($table->hasActions()): ?>
                    <th></th>
                <?php endif; ?>
            </tr>
            <tr>
                <th colspan="<?= count($table->getColumns()) + (int)$table->hasActions()?>">
                    <button class="waves-effect waves-light btn indigo accent-2 right" type="submit" style="margin-left:10px;">Filtra</button>
                    <?= $this->Html->link('Reset', [], ['class' => 'waves-effect waves-light btn indigo accent-2 right']) ?>
                </th>
            </tr>
        <?php endif; ?>
    </thead>
    <tbody>
        <?php foreach($table->getCollection() as $row): ?>
            <tr>
                <?php foreach($table->getColumns() as $column => $options): ?>
                    <td>
                        <?= $table->getFormattedColumn($column, $row, $this); ?>
                    </td>
                <?php endforeach; ?>
                <?php if($table->hasActions()): ?>
                    <td>
                        <a href="#" data-activates="line<?= $row->{$table->getEntityId()}?>Action" class="dropdown-button right">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul id='line<?= $row->{$table->getEntityId()}?>Action' class='dropdown-content'>
                            <?php foreach($table->getActions() as $action => $options): ?>
                                <li>
                                    <?php if($table->getActionType($action) == 'get'): ?>
                                        <?= 
                                            $this->Html->link($table->getActionTitle($action), 
                                                $table->getActionUrl($action, $row)
                                            ); 
                                        ?>
                                    <?php else: ?>
                                        <?php
                                            echo $this->Form->postLink(
                                                $table->getActionTitle($action), 
                                                $table->getActionUrl($action, $row),
                                                $table->getActionOptions($action) + ['block' => 'table_forms']
                                            ); 
                                        ?>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php if($table->paginate()): ?>
    <?= $this->Form->end(); ?>
    <div class="paginator">
        <?= $this->element('paginator'); ?>
    </div>
<?php endif; ?>
<?= $this->fetch('table_forms'); ?>