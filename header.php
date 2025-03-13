<?php
use Concrete\Core\Page\Page;
use Concrete\Core\Page\PageList;

// Get the top-level pages
$pl = new PageList();
$pl->filterByParentID(Page::getByID(1)->getCollectionID()); // ID 1 is usually the Home page
$pl->sortByDisplayOrder();
$pages = $pl->getResults();
?>

<nav class="mobile-nav">
    <ul class="mobile-menu">
        <?php foreach ($pages as $page): ?>
            <?php
            // Check if the page should be excluded
            if ($page->getAttribute('exclude_nav')) {
                continue;
            }

            // Get child pages and filter out excluded ones
            $children = [];
            foreach ($page->getCollectionChildren() as $child) {
                if (!$child->getAttribute('exclude_nav')) {
                    $children[] = $child;
                }
            }

            $hasChildren = count($children) > 0;
            ?>
            <li class="<?= $hasChildren ? 'has-children' : ''; ?>">
                <a href="<?= $page->getCollectionLink(); ?>"><?= $page->getCollectionName(); ?></a>

                <?php if ($hasChildren): ?>
                    <span class="toggle-submenu">+</span>
                    <ul class="sub-menu">
                        <?php foreach ($children as $child): ?>
                            <li>
                                <a href="<?= $child->getCollectionLink(); ?>"><?= $child->getCollectionName(); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>