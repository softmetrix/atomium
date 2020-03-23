<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Home', 'icon' => 'home', 'url' => ['/']],
                    [
                        'label' => 'Jobs',
                        'icon' => 'cogs',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Manage', 'icon' => 'th-list', 'url' => ['/job']],
                            ['label' => 'Add', 'icon' => 'plus', 'url' => ['/job/create']],
                        ],
                    ],
                    [
                        'label' => 'Steps',
                        'icon' => 'puzzle-piece',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Manage', 'icon' => 'th-list', 'url' => ['/step']],
                        ],
                    ],
                ],
            ]
        ); ?>

    </section>

</aside>
