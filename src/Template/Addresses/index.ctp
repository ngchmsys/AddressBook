<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Address[]|\Cake\Collection\CollectionInterface $addresses
 */
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Address'), ['action' => 'add'], ['class' => 'button']) ?></li>
    </ul>

    <div class="search form">
        <?= $this->Form->create($search) ?>
        <fieldset>
            <legend><?= __('Search') ?></legend>
            <?php
                echo $this->Form->control('searchWord');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Html->link(__('Clear'), ['action' => 'index'], ['class' => 'button']) ?>
        <?= $this->Form->end() ?>
    </div>
</nav>

<div class="addresses index large-9 medium-8 columns content">
    <h3><?= __('Addresses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('furigana') ?></th>
                <th scope="col"><?= $this->Paginator->sort('post') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($addresses as $address): ?>
            <tr>
                <td>
                    <?= $this->Html->link($this->Number->format($address->id), ['action' => 'view', $address->id]) ?>
                </td>
                <td><?= h($address->name) ?></td>
                <td><?= h($address->furigana) ?></td>
                <td><?= h($address->post) ?></td>
                <td><?= h($address->address) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $address->id], ['class' => 'button']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $address->id], ['class' => 'button', 'confirm' => __('Are you sure you want to delete # {0}?', $address->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($this->Paginator->total() > 1): ?>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
    <?php endif; ?>
</div>
