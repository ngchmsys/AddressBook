# ビューの構築

## 事前準備

## Template

**ビューの生成**

```sh
[root@localhost AddressBook]# bin/cake bake template addresses

Baking `index` view template file...

Creating file /var/www/html/AddressBook/src/Template/Addresses/index.ctp
Wrote `/var/www/html/AddressBook/src/Template/Addresses/index.ctp`

Baking `view` view template file...

Creating file /var/www/html/AddressBook/src/Template/Addresses/view.ctp
Wrote `/var/www/html/AddressBook/src/Template/Addresses/view.ctp`

Baking `add` view template file...

Creating file /var/www/html/AddressBook/src/Template/Addresses/add.ctp
Wrote `/var/www/html/AddressBook/src/Template/Addresses/add.ctp`

Baking `edit` view template file...

Creating file /var/www/html/AddressBook/src/Template/Addresses/edit.ctp
Wrote `/var/www/html/AddressBook/src/Template/Addresses/edit.ctp`
```

> src/Template/Addresses/index.ctp

```php
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
```

> src/Template/Addresses/view.ctp

```php
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Address $address
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Address'), ['action' => 'edit', $address->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Address'), ['action' => 'delete', $address->id], ['confirm' => __('Are you sure you want to delete # {0}?', $address->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Addresses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Address'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="addresses view large-9 medium-8 columns content">
    <h3><?= h($address->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($address->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Furigana') ?></th>
            <td><?= h($address->furigana) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Post') ?></th>
            <td><?= h($address->post) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($address->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Address') ?></h4>
        <?= $this->Text->autoParagraph(h($address->address)); ?>
    </div>
</div>
```

> src/Template/Addresses/add.ctp

```php
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Address $address
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Addresses'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="addresses form large-9 medium-8 columns content">
    <?= $this->Form->create($address) ?>
    <fieldset>
        <legend><?= __('Add Address') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('furigana');
            echo $this->Form->control('post');
            echo $this->Form->control('address');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
```

> src/Template/Addresses/edit.ctp

```php
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Address $address
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $address->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $address->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Addresses'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="addresses form large-9 medium-8 columns content">
    <?= $this->Form->create($address) ?>
    <fieldset>
        <legend><?= __('Edit Address') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('furigana');
            echo $this->Form->control('post');
            echo $this->Form->control('address');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
```