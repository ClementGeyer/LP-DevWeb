<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerTadOfcg\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerTadOfcg/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerTadOfcg.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerTadOfcg\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerTadOfcg\App_KernelDevDebugContainer([
    'container.build_hash' => 'TadOfcg',
    'container.build_id' => 'daeb6518',
    'container.build_time' => 1637048987,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerTadOfcg');
